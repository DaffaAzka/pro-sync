<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    function store(Request $request, $username)
    {
        $user =  auth()->guard('api')->user();
        $partnerId = User::where('username', $username)->value('id');
        $success = null;

        $request['user_id'] = $user->id;
        $request['partner_id'] = $partnerId;
        $request['status'] = "pending";

        if (Partner::where('user_id', $user->id)->where('partner_id', $partnerId)->exists()) {
            $success = [
                'message' => "Successfully sending partner request to ",
                'username' => $username
            ];

            Partner::create($request->all());
        } else {
            $fail = [
                'message' => "Sending request failed to " . $username . " because you're already sent it.",
            ];
        }

//        dd("Successfully sending partner request to " . $username);
        return view('partners.lists', [
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'profile' => $user->profile_img ?? 'guest.jpg'
            ],
            'page' => [
                'partners' => true,
                'connect' => false,
            ],
            'partners' => [],
            'pending' => $this->userRequest($user->id),
            'success' => $success,
        ]);
    }

    function show(Request $request)
    {
        $user =  auth()->guard('api')->user();
        $success = null;
        return view('partners.lists', [
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'profile' => $user->profile_img ?? 'guest.jpg'
            ],
            'page' => [
                'partners' => true,
                'connect' => false,
            ],
            'partners' => [],
            'pending' => $this->userRequest($user->id),
            'success' => $success,
        ]);
    }

    function findUser(Request $request)
    {
        $user =  auth()->guard('api')->user();
        $success = null;

        if ($request['usage'] == 'connect') {
            /**
             * Note: Carikan saya data user berdasarkan inputan yang mirip dengan username lalu ambil id nya dan
             *       seleksi berdasarkan yang tidak memiliki hubungan dengan id saya lalu ambil datanya
             */
            $usersToConnect = User::where('username', 'like', '%' . $request['username'] . '%')
                ->whereNotIn('id', Partner::where('user_id', $user->id)->pluck('partner_id')->toArray())
                ->get() ->makeHidden(['password', 'created_at', 'updated_at']);

            $page = [
                'partners' => false,
                'connect' => true,
            ];
        } else {
            $usersToConnect = User::where('username', 'like', '%' . $request['username'] . '%')
                ->whereIn('id', Partner::where('user_id', $user->id)->pluck('partner_id')->toArray())
                ->get() ->makeHidden(['password', 'created_at', 'updated_at']);
            $page = [
                'partners' => true,
                'connect' => false,
            ];
        }

        return view('partners.lists', [
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'profile' => $user->profile_img ?? 'guest.jpg'
            ],
            'page' => $page,
            'partners' => $usersToConnect,
            'pending' => $this->userRequest($user->id),
            'success' => $success,
        ]);
    }

    function userRequest(int $id) {
        /**
         * Note: Carikan saya data user yang memiliki user_id yang sama dengan saya didalam table Partner dan ambil (pluck)
         *       user berdasarkan partner_id
         */
        return User::whereIn('id', Partner::where('user_id', $id)->where('status', 'pending')->pluck('partner_id'))
                    ->get() ->makeHidden(['password', 'created_at', 'updated_at']);
    }

    function destroy($id)
    {

    }
}

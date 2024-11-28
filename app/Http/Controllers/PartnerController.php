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

        if (!Partner::where('user_id', $user->id)->where('partner_id', $partnerId)->exists()) {
            $success = [
                'message' => "Successfully sending partner request to ",
                'username' => $username
            ];

            Partner::create($request->all());
        }

        return redirect()->to(route('partners.show'))->with('success', $success);
    }

    function show(Request $request)
    {
        $user =  auth()->guard('api')->user();

//        $dump = User::select('username')->get();
//        dd($this->getMyPartners());

        return view('partners.lists', [
            'user' => [
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'profile' => $user->profile_img ?? 'guest.jpg'
            ],
            'page' => [
                'partners' => true,
                'connect' => false,
                'pending' => false,

            ],
            'partners' => $this->getMyPartners($request),
            'connects' => [],
            'pending' => $this->userRequest($request, $user->id),
        ]);
    }

    function findUser(Request $request)
    {
        $user =  auth()->guard('api')->user();

        if ($request['type'] == 'connect') {
            /**
             * Note: Carikan saya data user berdasarkan inputan yang mirip dengan username lalu ambil id nya dan
             *       seleksi berdasarkan yang tidak memiliki hubungan dengan id saya lalu ambil datanya
             */
            $usersToConnect = User::where('username', 'like', '%' . $request['username'] . '%')
                ->where('username', '!=', $user->username)
                ->whereNotIn('id', Partner::where('user_id', $user->id)->pluck('partner_id')->toArray())
                ->select('id', 'name', 'username', 'profile_img')->latest()->paginate(4)->withQueryString();

            $page = [
                'partners' => false,
                'connect' => true,
                'pending' => false,
            ];

            $partners = $this->getMyPartners($request);
        } else {
//            dd($request['username']);
            $partners = User::where('username', 'like', '%' . $request['username'] . '%')
                ->whereIn('id', Partner::where('user_id', $user->id)->pluck('partner_id')->toArray())
//                ->whereIn('id', Partner::where('user_id', $user->id)->select('partner_id')->get())
                ->select('id', 'name', 'username', 'profile_img')->latest()->paginate(4)->withQueryString();
            $page = [
                'partners' => true,
                'connect' => false,
                'pending' => false,
            ];
            $usersToConnect = [];
        }

//        dd($partner);

        return view('partners.lists', [
            'user' => [
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'profile' => $user->profile_img ?? 'guest.jpg'
            ],
            'page' => $page,
            'partners' => $partners,
            'connects' => $usersToConnect,
            'pending' => $this->userRequest($request, $user->id),
        ]);
    }

    function userRequest(Request $request, int $id) {
        /**
         * Note: Carikan saya data user yang memiliki user_id yang sama dengan saya didalam table Partner dan ambil (pluck)
         *       user berdasarkan partner_id
         */

        return User::whereIn('id', Partner::where('user_id', $id)->where('status', 'pending')
            ->orderBy('created_at', 'desc')->pluck('partner_id'))
            ->select('id', 'name', 'username', 'profile_img')
            ->latest()->paginate(4)->withQueryString();
    }

    function getMyPartners(Request $request)
    {
        $user =  auth()->guard('api')->user();
        return $user->partners()->wherePivot('status', "partner")->latest()->paginate(4)->withQueryString();
    }

    function destroy($id)
    {

    }
}

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

        $request['user_id'] = $user->id;
        $request['partner_id'] = $partnerId;
        $request['status'] = "pending";

        Partner::create($request->all());
        dd("Successfully sending partner request to " . $username);
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
            'message' => "Successfully sending partner request to " . $username,
        ]);
    }

    function show(Request $request)
    {
        $user =  auth()->guard('api')->user();
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
            'partners' => []
        ]);
    }

    function findUser(Request $request)
    {
        $user =  auth()->guard('api')->user();

        if ($request['usage'] == 'connect') {
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



//        dd($usersToConnect[1]->id);

        return view('partners.lists', [
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'profile' => $user->profile_img ?? 'guest.jpg'
            ],
            'page' => $page,
            'partners' => $usersToConnect
        ]);
    }
}

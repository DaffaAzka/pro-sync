<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartnerController extends Controller
{
    //
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
                'partners' => false,
                'connect' => true,
                'search' => false
            ]
        ]);
    }
}

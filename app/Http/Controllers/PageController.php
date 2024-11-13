<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class PageController extends Controller
{
    //

    function dashboard(Request $request)
    {
        $user =  auth()->guard('api')->user();
        return view('dashboard', [
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
            ]
        ]);

    }

}

<?php

namespace App\Http\Controllers;

use App\Mail\VerifyMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Random\RandomException;

class AuthController extends Controller
{
    /**
     * @throws RandomException
     */

    function login(Request $request) {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where("email", "=", $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {

            if (!$user->security) {
                $token = $user->createToken('login')->accessToken;
                Cookie::queue('Authorization', $token, 43200);
                return redirect()->route('dashboard');
            } else {
                return $this->verifyEmail($request, $user->email);
            }

        }

        return redirect()->route('login')->with('error', 'It looks like some field is incorrect!');
    }

    /**
     * @throws RandomException
     */
    function verifyEmail(Request $request, String $email): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $randomNumber = random_int(100000, 999999);
        $authCode = $randomNumber;

        Cache::put('verify_code_' . $request->ip(), $authCode, now()->addMinutes(3));
        Mail::to($email)->send(new VerifyMail($authCode));

        session(['email' => $email]);
        Session::forget('error');

        return view('verify');
    }

    /**
     * @throws ConnectionException
     */
    function getTokens(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        $code = $request->code;
        $user = User::where('email', '=', $request->email)->first();
        if ($code == Cache::get('verify_code_' . $request->ip())) {

            Cache::forget('verify_code_' . $request->ip());
            Session::flush();
            $token = $user->createToken('login')->accessToken;
            Cookie::queue('Authorization', $token, 43200);
            return redirect()->route('dashboard');

        }

        session(['error' => 'Incorrect verification code. Try again!']);
        return view('verify');
    }

    function revokeToken(Request $request): \Illuminate\Http\RedirectResponse
    {
        Cookie::queue(Cookie::forget('Authorization'));
        return redirect()->route('dashboard');
    }

}

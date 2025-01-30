<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UnAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null): Response
    {
//        dd(Auth::guard($guard)->hasUser());
        if (Auth::guard($guard)->check()) {
            Log::info('User is authenticated. Redirecting to dashboard.');
            return redirect()->route('dashboard');
        }

        Log::info('User is not authenticated. Proceeding with request.');

        return $next($request);
    }

}

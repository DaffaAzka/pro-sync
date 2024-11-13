<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class SetBearerToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $token = Cookie::get('Authorization');
        if ($token) {
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }
        return $next($request);
    }
}

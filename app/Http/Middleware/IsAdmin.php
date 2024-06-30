<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);

        // Check if the user is logged in and is an admin
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return $next($request);
        }

        // If not an admin, redirect or return an unauthorized response
        return redirect('/')->with('error', 'You are not authorized to access this page.');
    }
}

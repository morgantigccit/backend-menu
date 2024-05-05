<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and is a super admin
        if (Auth::check() && Auth::user()->role=="superadmin") {
            return $next($request);
        }

        // If the user is not a super admin, redirect them with an error message
        return redirect('/')->with('error', 'You do not have super admin access.');
    }
}

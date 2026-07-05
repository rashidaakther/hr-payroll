<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsEmployee
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'employee') {
            return $next($request);
        }
        else {
            // Redirect to login page with an error message
            return redirect()->route('login')->withErrors([
                'access_denied' => 'Access Denied. You do not have permission to access this resource.',
            ]);
        }
    }
}
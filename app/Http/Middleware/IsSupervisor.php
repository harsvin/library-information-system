<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsSupervisor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // This line checks if the user is authenticated and is a supervisor.
        if (Auth::check() && Auth::user()->is_supervisor) {
        return $next($request); // If the user is authenticated and is a supervisor, it allows the request to proceed to the next middleware or route handler.
    }

        return redirect('/home')->with('error', 'You do not have supervisor access.');
    }
}

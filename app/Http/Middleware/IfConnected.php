<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IfConnected
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // if not connected, redirect to login page
        if (! auth()->check()) {
            return redirect('/login')->withErrors([
                'email' => "You must be logged to view this page.",
            ]);    
        }
        return $next($request);
    }
}

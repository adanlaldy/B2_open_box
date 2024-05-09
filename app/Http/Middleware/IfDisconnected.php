<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IfDisconnected
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // if connected, redirect to inbox page
        if (auth()->check()) {
            return redirect('/inbox')->withErrors([
                'email' => 'You must be disconnect to view this page.',
            ]);
        }

        return $next($request);
    }
}

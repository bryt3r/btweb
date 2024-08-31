<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WriterAccess
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
        if (Auth::check() and Auth::user()->is_banned) {
            return redirect()->route('beta-home');
        }

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->is_admin || Auth::user()->role == 'writer') {
            return $next($request);
        }

        if (Auth::user()->role == 'lister') {
            return redirect()->route('dashboard');
        }


        if (Auth::user()->role == 'guest' || Auth::user()->role == null) {
            return redirect()->route('beta-home');
        }

        //return $next($request);
    }
}

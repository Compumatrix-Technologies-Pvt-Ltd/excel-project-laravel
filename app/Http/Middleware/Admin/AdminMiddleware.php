<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if(auth()->check())
        // {
        //     return $next($request);
        // }else{
        //     //dd('gf');
        //     auth()->logout();
        //     return redirect('/');
        // }
        if (Auth::check()) {
            // Check if user status is inactive (assuming 'inactive' is 0 or a string like 'inactive')
            if (Auth::user()->status == 'inactive' || Auth::user()->status == 0) {
                Auth::logout();
                return redirect('/')->with('error', 'Your account is inactive.');
            }

            return $next($request);
        } else {
            Auth::logout();
            return redirect('/')->with('error', 'Please log in to access this page.');
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
class AlreadyLoggedIn
{
    public function handle(Request $request, Closure $next)
    {
        if(Session::has('ParentID')){
            return redirect('/dashboard');

        }
        return $next($request);
    }
}

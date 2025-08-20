<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
class AuthCheck
{
    
    public function handle(Request $request, Closure $next)
    {
        if(!Session::has('ParentID')){
            return redirect('/login');
        }
        
        return $next($request);
    }
}

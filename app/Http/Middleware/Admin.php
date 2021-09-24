<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
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
        // return $next($request);
        if(auth()->guard('admin')->check()){
            return $next($request);
        }
        return redirect('/')->with('error',"You don't have admin access.");
    }
}

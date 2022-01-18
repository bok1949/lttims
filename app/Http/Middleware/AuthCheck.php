<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
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
        if(!session()->has('authID')){
            /* dd('middleware redirect to login'); */
            /* dd($request->url() .'=='.url()->route('ao.login')); */
            return redirect()->route('ao.login')->with('fail', 'You must logged in');
        }
        
        return $next($request);
    }
}

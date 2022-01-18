<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlreadyLoggedIn
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
        /* Get user role */
        $urole = DB::table('users')->select('user_role')->where('id', session('authID'))->first();
        
        if(session()->has('authID') && (url()->route('ao.login') == $request->url() || url()->route('ao.register')==$request->url()) ){
            /* abort(403, 'Unauthorized action.'); */
            /* return back(); */
            /* dd('already loggedin'); */
            if($urole->user_role == 'establishment'){           
                return redirect()->route('estab.dashboard');
            }
            if($urole->user_role == 'admin'){
                              
                return redirect()->route('ao.admin-dashboard');
            }
        }
        return $next($request);
    }
}

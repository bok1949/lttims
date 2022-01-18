<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOnly
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
        
        if($urole->user_role != 'admin'){
            /* dd('Admin only page'); */
            
            return redirect()->route('ao.login');
            // return back();
        }
        return $next($request);
    }
}

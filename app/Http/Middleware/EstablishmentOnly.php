<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstablishmentOnly
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
        /* dd($urole->user_role); */
        if($urole->user_role != 'establishment'){
            /* dd('establishment page only'); */
            return redirect()->route('ao.login');
        }
        return $next($request);
    }
}

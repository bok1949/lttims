<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function adminDashboard(){
        /* dd($current = url()->current()); */
        //return session('authID');
        $user = DB::table('users')->where('id', session('authID'))->first();
        $data = [
            'loggedUserInfo'   => $user 
        ];
        return view('ao-pages.admin-pages.admin-dashboard', $data);
    }

    public function manageEstablishment(){
        $data = DB::table('establishment_user_infos')->orderBy('created_at', 'asc')->simplePaginate(1);
        return view('ao-pages.admin-pages.manage-establishment', compact('data'));
    }

    public function manageEvents(){
        return view('ao-pages.admin-pages.manage-events');
    }

    public function manageReports(){

        return view('ao-pages.admin-pages.manage-reports');
    }
}

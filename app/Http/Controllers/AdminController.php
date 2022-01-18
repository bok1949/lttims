<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function adminDashboard(){
        /* dd($current = url()->current()); */
        /* return session('authID'); */
        $user = DB::table('users')->where('id', session('authID'))->first();
        /* $data = [
            'loggedUserInfo'   => $user 
        ]; */
        //dd($user);
        return view('ao-pages.admin-pages.admin-dashboard', compact('user'));
    }

    public function manageEstablishment(){
        $user = DB::table('users')->where('id', session('authID'))->first();
       
        $data = DB::table('establishment_user_infos')->orderBy('created_at', 'asc')->simplePaginate(1);
        return view('ao-pages.admin-pages.manage-establishment', compact('data', 'user'));
    }

    public function manageEvents(){
        $user = DB::table('users')->where('id', session('authID'))->first();
        return view('ao-pages.admin-pages.manage-events', compact('user'));
    }

    public function manageReports(){
        $user = DB::table('users')->where('id', session('authID'))->first();
        return view('ao-pages.admin-pages.manage-reports', compact('user'));
    }

    public function managePersonalProfile(){
        $user = DB::table('users')->where('id', session('authID'))->first();
        return view('ao-pages.admin-pages.manage-personal-profile', compact('user'));
    }
}

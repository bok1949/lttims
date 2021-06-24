<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePagesController extends Controller
{
    public function lttimsHome(){
        return view('homepage');
    }
}

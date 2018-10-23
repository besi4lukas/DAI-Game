<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('dai_views.user_profile') ;
    }

    public function users(){
        return view('dai_views.users') ;
    }
}

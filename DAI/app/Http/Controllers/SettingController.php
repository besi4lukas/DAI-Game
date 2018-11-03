<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index(){
        if (Auth::check()) {

            return view('dai_views.settings');

        }else{
            return redirect('/login') ;
        }
    }

    public function help(){
        if (Auth::check()){

            return view('dai_views.help');
        }
        else{
            return redirect('/login') ;
        }
    }
}

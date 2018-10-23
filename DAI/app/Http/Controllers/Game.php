<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Game extends Controller
{

    public function index(){

        return view('dai_views.game') ;
    }

    public function one_on_one(){

        return view('dai_views.one_on_one') ;
    }
}

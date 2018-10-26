<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeagueController extends Controller
{

    public function index(){

        return view('dai_views.league') ;
    }


    public function user_league(){
        return view('dai_views.user_league');

    }

    public function game($_game_id){

        $game_id = $_game_id ;

        return view('dai.views.game',compact('game_id')) ;
    }
}

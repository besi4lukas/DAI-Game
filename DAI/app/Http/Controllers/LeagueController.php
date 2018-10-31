<?php

namespace App\Http\Controllers;

use App\League;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeagueController extends Controller
{

    public function index(){

        return view('dai_views.league') ;
    }


    public function user_league(){

        return view('dai_views.user_league');

    }

    public function createLeague(Request $request){
        if (Auth::check()) {

            $league = new League();
            $user = Auth::user();
            $league->league_name = $request->league;
            $league->league_status = $request->status;
            $league->league_founder = $user->id;
            $league->save();

        }else{
            return redirect('/login') ;
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\User;
use App\User_Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $user_profile = DB::select('select * from user__profiles where user_id = ?',[$user->id]) ;

        $games_won = DB::select('select count(*) as games from results where winner_id = ?',[$user->id]) ;

        $leagues = DB::select('select count(league_id) as leagues from league__rankings where user_id = ?',[$user->id]) ;

        $data = array([
            'profile'=> $user_profile,
            'games'=>$games_won,
            'leagues'=>$leagues
        ]) ;

//        dd($data[0]['profile'][0]->username) ;
        return view('dai_views.dashboard',compact('data'));
    }
}

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
        $result_count = DB::select('select count(*) as count from results where winner_id = ? or loser_id = ?',[$user->id,$user->id]);
        $leaders = DB::select('select * from user__profiles order by user_coins DESC LIMIT 4');
        $title = array('Mansa Musa','gates','Bezos','Dangote');


        $data = array([
            'profile'=> $user_profile,
            'games'=>$games_won,
            'leagues'=>$leagues,
            'played'=>$result_count
        ]) ;

        $user_pro = User_Profile::where('user_id',$user->id)->first();

        $game_level = array('Beginner','Amateur','Professional','Expert','Master','Grand Master');

        if ($user_pro->user_coins <= 950){
            $user_pro->level = $game_level[0] ;
            $user_pro->save() ;
        }

        if ($user_pro->user_coins >= 1000 and $user_pro->user_coins <= 1950){
            $user_pro->level = $game_level[1] ;
            $user_pro->save() ;
        }

        if ($user_pro->user_coins >= 2000 and $user_pro->user_coins <= 3950){
            $user_pro->level = $game_level[2] ;
            $user_pro->save() ;
        }

        if ($user_pro->user_coins >= 4000 and $user_pro->user_coins <= 7950){
            $user_pro->level = $game_level[3] ;
            $user_pro->save() ;
        }

        if ($user_pro->user_coins >= 8000 and $user_pro->user_coins <= 15950){
            $user_pro->level = $game_level[4] ;
            $user_pro->save() ;
        }

        if ($user_pro->user_coins >= 16000){
            $user_pro->level = $game_level[5] ;
            $user_pro->save() ;
        }


        return view('dai_views.dashboard',compact('data','leaders','title'));
    }
}

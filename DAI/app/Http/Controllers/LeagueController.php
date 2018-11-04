<?php

namespace App\Http\Controllers;

use App\League;
use App\League_Admin;
use App\League_Ranking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeagueController extends Controller
{

    public function index(){

        if (Auth::check()) {
            $user = Auth::user()->id;
            $all_leagues = DB::select('select distinct league_id from league__rankings');
            $league_rankings = League_Ranking::where('user_id', $user)->get() ;
            $league_admins = League_Admin::where('user_id',$user)->get();
            $admin = array() ;
            $leagues_all = array();
            $league_all_players = array() ;
            $leagues_user = array();
            $league_players = array() ;
            $count = 0 ;
            $count_ = 0 ;
            $_count = 0 ;
            $id_array = array() ;

            foreach ($league_admins as $league_admin){
                $admin[$_count] = $league_admin->league_id ;
                $_count += 1 ;
            }

            foreach ($league_rankings as $league_ranking){

                $name = League::where('id',$league_ranking->league_id)->first();
                $players = DB::select('select count(league_id) as players from league__rankings where league_id =?',[$league_ranking->league_id]);
                $leagues_user[$count] = $name ;
                $id_array[$count] = $name->id ;
                $league_players[$count] = $players[0]->players ;

                $count += 1 ;
            }

            foreach ($all_leagues as $all_league){

                $name = League::where('id',$all_league->league_id)->first();
                $players = DB::select('select count(league_id) as players from league__rankings where league_id = ?',[$all_league->league_id]) ;
                $leagues_all[$count_] = $name ;
                $league_all_players[$count_] = $players[0]->players ;

                $count_ += 1 ;
            }

            return view('dai_views.league',compact('leagues_all','league_all_players',
                'leagues_user','league_players','id_array','admin'));

        }else{
            return redirect('/login') ;
        }
    }


    public function user_league($id){

        if (Auth::check()) {

            $league = League::where('id',$id)->first() ;
            $player_names = array() ;
            $score = array() ;
            $coins = array() ;
            $count = 0 ;
            $user = Auth::user()->id ;
            $status = "won" ;
            $winningRatio = 0 ;
            $points = 0 ;

            $gamesplayed = DB::select('select count(*) as count from league_game_playeds where user_id = ?',[$user]) ;

            $gamesWon = DB::select('select count(*) as count from league_game_playeds where status = ?',[$status]);

            $score_user = DB::select('select score from league__rankings where league_id = ? and user_id = ?',[$id,$user]);

            if (! $gamesplayed[0]->count == 0){
                $winningRatio = $gamesWon[0]->count / $gamesplayed[0]->count ;
                $points = $winningRatio * $score_user[0]->score ;
            }


            $league_rankings = DB::select('select * from league__rankings where league_id = ? order by  score DESC ',[$id]);

            foreach ($league_rankings as $league_ranking){

                if (!($league_ranking->user_id == $user)) {

                    $user_profile = DB::select('select * from user__profiles where user_id = ?', [$league_ranking->user_id]);

                    $player_names[$count] = $user_profile[0]->username;
                    $score[$count] = $league_ranking->score;
                    $coins[$count] = $user_profile[0]->user_coins;

                    $count += 1;

                }
            }


            return view('dai_views.user_league',compact('league','player_names','score','coins','winningRatio','points'));

        } else{
            return redirect('/login') ;
        }

    }

    public function joinLeague($id){

        if (Auth::check()) {

            $league_ranking = new League_Ranking();
            $league_ranking->score = 0;
            $league_ranking->league_id = $id;
            $league_ranking->user_id = Auth::user()->id;
            $league_ranking->save();

            return $this->index() ;
        }else{

            return redirect('/login') ;
        }

    }

    public function createLeague(Request $request){

        if (Auth::check()) {
            $role = "admin" ;
            $league = new League();
            $user = Auth::user();
            $league->league_name = $request->league;
            $league->status = $request->status;
            $league->league_founder = $user->id;

            if($league->save()){

                $league_admin = new League_Admin() ;
                $league_admin->user_role = $role ;
                $league_admin->user_id = $user->id ;
                $league_admin->league_id = $league->id ;

                if($league_admin->save()) {

                    $league_ranking = new League_Ranking() ;
                    $league_ranking->score = 0 ;
                    $league_ranking->league_id = $league->id ;
                    $league_ranking->user_id = $user->id ;
                    $league_ranking->save() ;
                }

                return back();

            }


        }else{

            return redirect('/login') ;
        }
    }

    public function delete_league(Request $request){
        if (Auth::check()){
            $league_id = $request->league_id ;
            League::where('id',$league_id)->delete();

            return back() ;
        }else{
            return redirect('/login') ;
        }
    }

}

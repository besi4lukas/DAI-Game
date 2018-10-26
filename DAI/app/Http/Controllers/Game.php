<?php

namespace App\Http\Controllers;

use App\Notifications\AcceptRequest;
use App\Notifications\AcceptRequestTwo;
use App\Notifications\DeclineRequest;
use App\Notifications\Requests;
use App\User;
use App\User_Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Game extends Controller
{

//    public function index($id){
//
//        $game_id = $id ;
//
//        return view('dai.views.game',compact('game_id')) ;
//    }

    public function index_player_two(Request $request){

        $game = new \App\Game();
        $status = "pending" ;

        $user_id = Auth::user()->id ;

        $id = $request->player_one ;
//        dd($request) ;
        $game->player_two = $user_id;
        $game->player_one = $id ;
        $game->game_no_two = $request->number ;
        $game->player_turn = 1 ;
        $game->status = $status ;

        $game->save();

//        $pending_game = \App\Game::where('player_one',$request->player_one)
//            ->where('player_two',Auth::user()->id)->where('status',$status)->first() ;

        $pending_game = DB::select('select * from games where player_one = ? and player_two = ? and status = ?',[$request->player_one,$user_id,$status]) ;

        $game_id = $pending_game[0]->id ;

        $player_one = User::where('id',intval($id))->first();

        $player_one->notify(new AcceptRequest($user_id,$game_id)) ;

        return redirect()->action('LeagueController@game',[$game_id]) ;
    }

    public function index_player_one(Request $request){

        $status = "active" ;
        $status_pending = "pending" ;
        $pending_game = \App\Game::where('id',$request->game_id)->where('status',$status_pending)->first() ;

        $pending_game->game_no_one = $request->number ;
        $pending_game->status = $status ;

        $pending_game->save() ;

        $game_id = $request->game_id ;

        return redirect()->action('LeagueController@game',[$game_id]) ; ;
    }

    public function one_on_one(){


        return view('dai_views.one_on_one') ;
    }



    public function battleRequest($id){

        $user = User::where('id', intval($id))->first() ;

        $sender_id = Auth::user()->id ;

        $user->notify(new Requests($sender_id));

        return $this->one_on_one() ;

    }

}

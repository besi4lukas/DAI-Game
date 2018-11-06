<?php

namespace App\Http\Controllers;

use App\Events\newAcceptRequest;
use App\Notifications\AcceptRequest;
use App\Notifications\AcceptRequestTwo;
use App\Notifications\DeclineRequest;
use App\Notifications\Requests;
use App\Result;
use App\User;
use App\User_Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Events\newRequest ;

class Game extends Controller
{

    //function returns a game board page
    public function index($id){

        if (Auth::check()) {

            $game_id = $id;

            return view('dai_views.game', compact('game_id'));

        }else{
            return redirect('/login') ;

        }
    }

    public function exit($id){
        if (Auth::check()){
            $user_id = Auth::user()->id ;
            $game_id = $id ;
            $other_player = null ;

            $game = \App\Game::where('id',$game_id)->first() ;

            if ($game->player_one == $user_id){

                $other_player = $game->player_two ;
            }
            else{
                $other_player = $game->player_one ;
            }

            $game->status = "ended" ;
            $game->save() ;

            $result = new Result() ;
            $result->winner_id = $other_player ;
            $result->loser_id = $user_id ;
            $result->game_id = $game_id ;
            $result->save() ;

            $my_profile = User_Profile::where('user_id',$user_id)->first();
            $my_coins = $my_profile->user_coins ;
            $my_profile->user_coins = $my_coins - 50 ;
            $my_profile->save() ;

            $other_profile = User_Profile::where('user_id',$other_player)->first();
            $other_coins = $other_profile->user_coins ;
            $other_profile->user_coins = $other_coins + 50 ;
            $other_profile->save() ;


            return redirect('/home') ;

        }
        else{
            return redirect('/login') ;
        }
    }

    //handles the post data for the proceed page and redirects to game board
    public function game_board(Request $request){

        if (Auth::check()){

            $game_id = $request->game_id ;

            $game = \App\Game::where('id',$game_id)->first() ;

            if ((!$game->game_no_one == null) and (!$game->game_no_two == null)){

                return redirect()->route('start',['id' => $game_id]);
            }
            else {

                $user_id = Auth::id();

                if ($user_id == $game->player_one) {
                    $game->game_no_one = $request->number;
                    $game->save();
                } else {
                    $game->game_no_two = $request->number;
                    $game->save();
                }

                return redirect()->route('start', ['id' => $game_id]);
            }
        }
        else{
            return redirect('/login');
        }
    }

    //function returns the proceed page
    public function proceed($id){

        if (Auth::check()){

            $game_id = $id ;

            return view('dai_views.proceed',compact('game_id')) ;

        }else{
            return redirect('/login') ;
        }

    }

    //creates a new game, notifies player one and redirects to proceed page
    public function index_player_two($id){

        if (Auth::check()) {

            $game = new \App\Game();
            $status = "pending";
            $user_id = Auth::user()->id;
            $game->player_two = $user_id;
            $game->player_one = $id;
            $game->game_no_two = null ;
            $game->player_turn = 1;
            $game->status = $status;
            $game->save();

            $pending_game = DB::select('select * from games where player_one = ? and player_two = ? and status = ?', [$id, $user_id, $status]);
            $game_id = $pending_game[0]->id;
            $player_one = User::where('id', $id)->first();
            $player_one->notify(new AcceptRequest($user_id, $game_id));

//            event(new newRequest($id)) ;


            return redirect()->route('proceed',['id'=>$game_id]);

        }else{
            return redirect('/login') ;
        }
    }

    //redirects player one to the proceed page
    public function index_player_one($id){

        if (Auth::check()) {

            $game_id = $id ;

            $game = \App\Game::where('id',$game_id)->first() ;
            $game->status = "active" ;
            $game->save() ;

            return redirect()->route('proceed',['id'=>$game_id]);

        }else{

            return redirect('/login') ;

        }
    }

    //returns the one on one page
    public function one_on_one(){

        if (Auth::check()) {

            $user = Auth::user();
            $active_games = array();
            $Actives = DB::select('select * from games where (player_one = ? or player_two = ?) and status = ?', [$user->id, $user->id, "active"]);
            $count = 0;
            $game_id = array();

            foreach ($Actives as $active) {
                if ($active->player_one == $user->id) {
                    $player_two = $active->player_two;
                    $user_profile = User_Profile::where('user_id', $player_two)->first();
                    $active_games[$count] = $user_profile;
                    $game_id[$count] = $active->id;
                } else {
                    $player_one = $active->player_one;
                    $user_profile = User_Profile::where('user_id', $player_one)->first();
                    $active_games[$count] = $user_profile;
                    $game_id[$count] = $active->id;
                }
                $count += 1;
            }

            return view('dai_views.one_on_one', compact('active_games', 'game_id'));
        }else{
            return redirect('/login') ;
        }
    }


    //sends a battle request to a player
    public function battleRequest($id){

        if (Auth::check()) {

            $user = User::where('id', intval($id))->first();

            $sender_id = Auth::user()->id;

            $user->notify(new Requests($sender_id));

            event(new newRequest(intval($id)));

            return back();

        }else{
            return redirect('/login') ;
        }

    }

}

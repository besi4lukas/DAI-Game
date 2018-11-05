<?php

namespace App\Http\Controllers;

use App\Events\newAcceptRequest;
use App\Notifications\AcceptRequest;
use App\Notifications\AcceptRequestTwo;
use App\Notifications\DeclineRequest;
use App\Notifications\Requests;
use App\User;
use App\User_Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Events\newRequest ;

class Game extends Controller
{

    public function index($id){

        if (Auth::check()) {

            $game_id = $id;

            return view('dai_views.game', compact('game_id'));

        }else{
            return redirect('/login') ;
        }
    }

    public function game_board(Request $request){

        if (Auth::check()){

            $game_id = $request->game_id ;
            $game = \App\Game::where('id',$game_id)->first() ;
            $user_id = Auth::id() ;

            if ($user_id == $game->player_one){
                $game->game_no_one = $request->number ;
                $game->save() ;
            }
            else{
                $game->game_no_two = $request->number ;
                $game->save() ;
            }

            return redirect()->route('start',['id' => $game_id]) ;
        }
        else{
            return redirect('/login');
        }
    }

    public function proceed($id){

        if (Auth::check()){

            $game_id = $id ;

            return view('dai_views.proceed',compact('game_id')) ;

        }else{
            return redirect('/login') ;
        }

    }

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
            event(new newRequest($id)) ;

            $_user = Auth::user();
            $_user->unreadNotifications->markAsRead() ;

            return $this->proceed($game_id);

        }else{
            return redirect('/login') ;
        }
    }

    public function index_player_one($id){

        if (Auth::check()) {

            $game_id = $id ;

            return $this->proceed($game_id);

        }else{

            return redirect('/login') ;

        }
    }

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



    public function battleRequest($id){

        if (Auth::check()) {

            $user = User::where('id', intval($id))->first();

            $sender_id = Auth::user()->id;

            $user->notify(new Requests($sender_id));

            event(new newRequest(intval($id)));

            return $this->one_on_one();

        }else{
            return redirect('/login') ;
        }

    }

}

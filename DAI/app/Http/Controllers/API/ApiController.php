<?php

namespace App\Http\Controllers\API;

use App\Events\playerTurn;
use App\Game;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function guess_endpoint(Request $request){

        $guess_number = $request->number ;
        $player_id = $request->player_id ;
        $game_id = $request->game_id ;
        $other_number = 0 ;
        $sender_id = null ;


        $game = Game::where('id',$game_id)->first();


        if($game->player_turn == 1){

            $other_number = $game->game_no_two ;
            $game->player_turn = 2 ;
            $sender_id = $game->player_two ;
            $game->save() ;

        }

        else{

            $other_number = $game->game_no_one ;
            $game->player_turn = 1 ;
            $sender_id = $game->player_one ;
            $game->save() ;
        }

        event(new playerTurn($sender_id)) ;

        return response()->json([$this->compare($guess_number,$other_number)],200);
    }


    public function compare($_guess, $_number){

        $number = $_number ;
        $guess = $_guess ;
        $dead = 0 ;
        $injured = 0 ;

        for ( $i = 0 ; $i < strlen($number) ; $i++){

            if (strpos($guess,$number[$i]) !== false){

                if (strcmp($number[$i],$guess[$i]) == 0){

                    $dead += 1 ;
                }
                else{

                    $injured += 1 ;
                }
            }
        }



        return array([
            'dead'=>$dead,
            'injured'=>$injured
        ]) ;

    }



    public function history(Request $request){

        $player_id = $request->player_id ;
        $game_id = $request->game_id ;


    }

    public function playerturn_endpoint(Request $request){

        $id = $request->game_id ;
        $game = Game::where('id',$id)->first();
        $player_id = null ;

        if ($game->player_turn == 1){
            $player_id = $game->player_one;
        }else{
            $player_id = $game->player_two ;
        }

        return $player_id ;
    }





}

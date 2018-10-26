<?php

namespace App\Http\Controllers\API;

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
        $dead = 0 ;
        $injured = 0 ;


        $game = DB::select('select * from games where id = ?',[$game_id]);

//        dd($game) ;
        if($game[0]->player_turn == 1){

            $other_number = $game[0]->game_no_two ;

        }

        else{

            $other_number = $game[0]->game_no_one ;
        }


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



}

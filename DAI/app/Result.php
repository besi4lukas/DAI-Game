<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{

    public function game(){

        return $this->belongsTo('App\Game','game_id','id') ;
    }

    public function user(){

        return $this->belongsTo('App\User','winner_id','id') ;
    }
}

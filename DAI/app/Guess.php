<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guess extends Model
{
    public function game(){

        return $this->belongsTo('App\Game','game_id','id') ;
    }
}

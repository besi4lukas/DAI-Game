<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League_Ranking extends Model
{
    public function league(){

        return $this->belongsTo('App\League','league_id','id') ;
    }

    public function user(){

        return $this->hasMany('App\User','user_id','id') ;
    }

}

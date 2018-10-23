<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League_Admin extends Model
{
    public function league(){

        return $this->belongsTo('App\League','league_id','id') ;
    }
}

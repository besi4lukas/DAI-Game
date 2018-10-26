<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    //

    public function users(){
        return $this->belongsTo('App\User','sender_id','id') ;
    }
}

<?php

namespace App\Http\Controllers;

use App\Notifications\AcceptRequest;
use App\Notifications\DeclineRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index(){

        return view('dai_views.notifications') ;
    }

//    public function acceptGame($id){
//
//        $player_one = User::where('id',intval($id))->first();
//
//        $player_one->notify(new AcceptRequest(Auth::user()->id));
//
//        return $this->index() ;
//
//    }

    public function declineGame($id)
    {

        $player_one = User::where('id',intval($id))->first();

        $player_one->notify(new DeclineRequest(Auth::user()->id));

        return $this->index();
    }
}

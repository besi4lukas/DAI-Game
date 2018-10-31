<?php

namespace App\Http\Controllers;

use App\User;
use App\User_Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        if (Auth::check()) {
            $user = Auth::user();

            $id = $user->id;

            $profile = DB::select('select * from user__profiles where user_id = ?', [$id]);


            return view('dai_views.user_profile', compact('profile'));

        }
        else{
            return redirect('/login');
        }
    }

    public function updateProfile(Request $request){
        if (Auth::check()) {
            $user = Auth::user();
            $user_profile = User_Profile::where('user_id', $user->id)->first();

//        dd($request);

            $user_table = User::where('id', $user->id)->first();
            $image = $user_profile->user_image;
            $coins = $user_profile->user_coins;
            $user_id = $user->id;

            $user_table->email = $request->email;
            $user_profile->username = $request->username;
            $user_profile->firstName = $request->firstName;
            $user_profile->lastName = $request->lastName;
            $user_profile->user_image = $image;
            $user_profile->user_coins = $coins;
            $user_profile->user_id = $user_id;

            if ($user_table->save()) {

                $user_profile->save();
            }

            return $this->index();
        }else{
            return redirect('/login') ;
        }
    }

    public function users(){
        return view('dai_views.users') ;
    }
}

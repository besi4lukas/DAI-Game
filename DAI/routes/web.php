<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/league','LeagueController@index');

Route::post('/game_two','Game@index_player_two')->name('game') ;

//Route::get('/game', function (){
//
//        return view('welcome') ;
//
//})->name('newGame') ;

Route::post('/game_one','Game@index_player_one')->name('gameLaunch') ;

Route::get('/one_on_one','Game@one_on_one');

Route::get('/battle/{id}','Game@battleRequest') ;

Route::get('/markAsRead', function (){
    auth()->user()->unreadNotifications->markAsRead() ;
});

//Route::get('/notifications/{id}','NotificationController@acceptGame');

Route::get('/notifications/delete/{id}','NotificationController@declineGame');

Route::get('/user_profile','UserController@index');

Route::post('/user_profile','UserController@updateProfile') ;

Route::get('/users','UserController@users') ;

Route::get('/notifications','NotificationController@index') ;


Route::get('/settings','SettingController@index') ;

Route::get('/user_league','LeagueController@user_league');




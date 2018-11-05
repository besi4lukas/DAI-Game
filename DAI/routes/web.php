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

Route::post('/league','LeagueController@createLeague');

Route::get('/game_two/{id}','Game@index_player_two');

Route::get('/game/{id}','Game@index')->name('start') ;

Route::get('/proceed','Game@proceed')->name('proceed') ;

Route::post('/proceed','Game@game_board')->name('game_board');

Route::get('/game_one/{id}','Game@index_player_one') ;

Route::get('/one_on_one','Game@one_on_one');

Route::get('/battle/{id}','Game@battleRequest') ;

Route::get('/exit/{id}','Game@exit');

Route::get('/markAsRead', function (){
    $_user = \Illuminate\Support\Facades\Auth::user();
    $_user->unreadNotifications->markAsRead() ;
});

//Route::get('/notifications/{id}','NotificationController@acceptGame');

Route::get('/notifications/delete/{id}','NotificationController@declineGame');

Route::get('/user_profile','UserController@index');

Route::post('/user_profile','UserController@updateProfile') ;

Route::post('/admin','UserController@make_admin')->name('make_admin') ;

Route::post('/delete_user','UserController@delete_user')->name('delete_user') ;

Route::get('/users','UserController@users') ;

Route::get('/notifications','NotificationController@index');

Route::get('/help','SettingController@help');


Route::get('/settings','SettingController@index') ;

Route::get('/user_league/{id}','LeagueController@user_league');

Route::post('/delete_league','LeagueController@delete_league')->name('deleteLeague');

Route::get('/join/{id}','LeagueController@joinLeague') ;





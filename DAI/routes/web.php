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

Route::get('/game','Game@index') ;

Route::get('/one_on_one','Game@one_on_one');

Route::get('/user_profile','UserController@index');

Route::get('/users','UserController@users') ;

Route::get('/notifications','NotificationController@index') ;

Route::get('/settings','SettingController@index') ;

Route::get('/user_league','LeagueController@user_league');

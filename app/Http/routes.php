<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function(){
    return view('home');
});

Route::get('login', 'LoginController@showLoginPage');

Route::get('dashboard', 'LoginController@showDashBoard')
    ->middleware(['auth']);

Route::get('logout', 'LoginController@logout');

Route::get('login/{provider}', 'LoginController@auth')
    ->where(['provider' => 'facebook|google|twitter']);

Route::get('login/{provider}/callback', 'LoginController@login')
    ->where(['provider' => 'facebook|google|twitter']);
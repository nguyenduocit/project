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

Route::get('/', function () {
    return view('quanlytaichinh.login');
});


Route::group(['prefix'=>'users'],function(){

	Route::get('getRegister',['as'=>'users.getRegister','uses'=>'Auth\AuthController@getRegister']);
	Route::post('postRegister',['as'=>'users.postRegister','uses'=>'Auth\AuthController@postRegister']);

});

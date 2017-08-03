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

Route::get('/',function(){
	return redirect('users/getLogin');
});


Route::group(['prefix'=>'users'],function(){

	// Rregister
	Route::get('getRegister',['as'=>'users.getRegister','uses'=>'Auth\AuthController@getRegister']);
	Route::post('postRegister',['as'=>'users.postRegister','uses'=>'Auth\AuthController@postRegister']);

	// login
	Route::get('getLogin',['as'=>'users.getLogin','uses'=>'Auth\AuthController@getLogin']);
	Route::post('postLogin',['as'=>'users.postLogin','uses'=>'Auth\AuthController@postLogin']);
	
	//logout 
	Route::get('getLogout',['as' =>'users.getLogout','uses' =>'Auth\AuthController@getLogout']);

	//confim email
	Route::get('getConfirmEmail/{token}',['as'=>'users.getConfirmEmail','uses' =>'Auth\AuthController@getConfirmEmail']);

	//forgot my password
	Route::get('getForgotPassword',['as'=>'users.getForgotPassword','uses' => 'Auth\PasswordController@getForgotPassword']);
	Route::post('postForgotPassword',['as'=>'users.postForgotPassword','uses' => 'Auth\PasswordController@postForgotPassword']);

	//reset password 
	Route::get('getTokenResetPassword/{token}',['as'=>'users.getTokenResetPassword','uses' =>"Auth\PasswordController@getTokenResetPassword"]);
	Route::get('getResetPassword',['as'=>'users.getResetPassword','uses'=>'Auth\PasswordController@getResetPassword']);
	Route::post('postResetPassword',['as'=>'users.postResetPassword','uses'=>'Auth\PasswordController@postResetPassword']);

	//user profile
	Route::get('getUserProfile',['as'=>'users.getUserProfile','uses'=>'Auth\AuthController@getUserProfile']);
	Route::post('postUserProfile',['as'=>'users.postUserProfile','uses'=>'Auth\AuthController@postUserProfile']);
	
});


Route::get('home',['as' =>'home','uses' =>'HomeController@index']);

Route::group(['prefix'=>'wallets'],function(){

	Route::get('getAdd',['as'=>'wallets.getAdd','uses'=>'WalletsController@getAdd']);
	Route::post('postAdd',['as'=>'wallets.postAdd','uses'=>'WalletsController@postAdd']);
	Route::get('getList',['as'=>'wallets.getList','uses'=>'WalletsController@getList']);
	Route::get('getDelete/{id}',['as'=>'wallets.getDelete','uses' =>'WalletsController@getDelete']);
	Route::get('keySearch/{key}',['as'=>'wallets.keySearch','uses'=>'WalletsController@keySearch']);
	Route::get('getEdit/{id}',['as'=>'wallets.getEdit','uses'=>'WalletsController@getEdit']);
	Route::post('postEdit/{id}',['as'=>'wallets.postEdit','uses'=>'WalletsController@postEdit']);
	
	//wallets
	Route::get('getInfoWallets/{id}',['as'=>'wallets.getInfoWallets','uses'=>'WalletsController@getInfoWallets']);
	
	// Transfers money
	Route::get('getListTransfers',['as'=>'wallets.getListTransfers','uses'=>'TransfersMoneyController@getListTransfers']);
	
	Route::get('getTransfersMoney',['as'=>'wallets.getTransfersMoney','uses'=>'TransfersMoneyController@getTransfersMoney']);
	Route::post('postTransfersMoney',['as'=>'wallets.postTransfersMoney','uses'=>'TransfersMoneyController@postTransfersMoney']);

	Route::get('getAmountTransfers/{id}',['as'=>'wallets.getAmountTransfers','uses'=>'TransfersMoneyController@getAmountTransfers']);
	Route::get('getDeleteTransfers/{id}',['as'=>'wallets.getDeleteTransfers','uses' =>'TransfersMoneyController@getDeleteTransfers']);

	Route::get('getEditTransfers/{id}',['as'=>'wallets.getEditTransfers','uses'=>'TransfersMoneyController@getEditTransfers']);
	Route::post('postEditTransfers/{id}',['as'=>'wallets.postEditTransfers','uses'=>'TransfersMoneyController@postEditTransfers']);

	Route::get('keySearchTransfers/{key}',['as'=>'wallets.keySearchTransfers','uses'=>'TransfersMoneyController@keySearchTransfers']);
});


Route::group(['prefix'=>'categorys'],function(){

	Route::get('getList',['as'=>'categorys.getList','uses'=>'CategorysController@getList']);

	// Add
	Route::get('getAdd',['as'=>'categorys.getAdd','uses'=>'CategorysController@getAdd']);
	Route::post('postAdd',['as'=>'categorys.postAdd','uses'=>'CategorysController@postAdd']);

	//Add Subcategories
	Route::get('getAddSubcategories/{id}',['as'=>'categorys.getAddSubcategories','uses'=>'CategorysController@getAddSubcategories']);
	Route::post('postAddSubcategories',['as'=>'categorys.postAddSubcategories','uses'=>'CategorysController@postAddSubcategories']);

	// Edit 
	Route::get('getEdit/{id}',['as'=>'categorys.getEdit','uses'=>'CategorysController@getEdit']);
	Route::post('postEdit/{id}',['as'=>'categorys.postEdit','uses'=>'CategorysController@postEdit']);

	//Delete
	Route::get('getDelete/{id}',['as'=>'categorys.getDelete','uses'=>'CategorysController@getDelete']);
});

Route::group(['prefix'=>'transection'],function(){

	

});
	

// route test
Route::get('sendMail',['as'=>'sendMail','uses'=>'Auth\AuthController@sendMail']);

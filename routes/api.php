<?php

use Illuminate\Http\Request;


Route::post('user/store','API\userController@register');
Route::post('user/login','API\userController@login');


//// USER API AUTH

Route::group(['middleware' => 'auth:api'], function(){

	////////////////////// MAIN CONTROLLER /////////////////
	Route::get('/main/index','API\mainController@index');

	///////////////////// Catg Controller /////////////////
	Route::get('/catg/{id}','API\catgController@index');
	Route::get('/catg/hot/{id}','API\catgController@hot');

	////////////////////// Proudct Controller ////////////
	Route::get('/proudct/{id}','API\itemController@show');
	Route::get('/proudct/moreItems/{catg}','API\itemController@moreItems');

	//////////////////basket Controller /////////////////
	Route::post('/basket/store','API\basketController@store');
	Route::get('/basket/index','API\basketController@index');
	Route::post('/basket/qty/update/{id}','API\basketController@updateQty');
	Route::get('/basket/destroy/{id}','API\basketController@destroy');

	//////////////////// Order Controller /////////////////////
	Route::post('/order/store','API\orderController@store');
	Route::get('/order/index','API\orderController@index');


	////////////////////// Fav Controller /////////////////
	Route::get('/fav/store/{id}','API\favController@store');
	Route::get('/fav/index','API\favController@index');
	Route::get('/fav/destroy/{id}','API\favController@destroy');

	/////////////////// ADS Controller /////////////////////
	Route::post('/ads/store','API\adsController@store');
	Route::get('/ads/index','API\adsController@index');
	Route::get('/ads/show/{id}','API\adsController@show');
	Route::post('/ads/search','API\adsController@search');

});
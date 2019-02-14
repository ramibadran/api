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



//Route::get('api/v1/hotels', 'API\HotelController@getHotels');
Route::get('api/v1/hotels', 'API\HotelController@getHotels'); 
Route::post('api/v1/token',['uses' => 'API\TokenController@token']);
Route::group(['middleware' => ['jwt.CustomAuth']], function (){
    //Route::get('api/v1/hotels', 'API\HotelController@getHotels'); 
        
});

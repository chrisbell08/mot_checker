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
	return view('spark::welcome');
});

// Dashboard
Route::get('home', ['middleware' => 'auth', 'as' => 'dashboard', 'uses' => 'DashboardController@home']);

// API Route Group - All routes here are excluded from CSRF protection
Route::group(['prefix' => 'api/v1/'], function()
{
	Route::post('casperPost', ['as' => 'api.casperPost', 'uses' => 'ApiController@casperPost']);
});

// Vehicle Lookup Route Group
Route::group(['prefix' => 'lookup/'], function()
{
	Route::get('new', ['as' => 'lookup.newForm', 'uses' => 'VehicleLookupController@newLookupForm']);
	Route::post('postNewLookup', ['as' => 'lookup.postNewLookup', 'uses' => 'VehicleLookupController@postNewLookup']);
	Route::get('getVehicleDetails/{id}', ['as' => 'lookup.getVehicleDetails', 'uses' => 'VehicleLookupController@getVehicleDetails']);
	Route::get('refreshLookup/{id}', ['as' => 'lookup.refresh', 'uses' => 'VehicleLookupController@refreshLookup']);
});





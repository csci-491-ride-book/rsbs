<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('RideRequests/{posting_id}', array('uses' => 'RideRequestsController@store'));
Route::get('/RidePostings', 'RidePostingsController@index');
Route::get('/User/show/{id}', 'UsersController@show');

Route::post('/RidePostings', 'RidePostingsController@search');

Route::resource('RideRequests', 'RideRequestsController');
Route::resource('Users', 'UsersController');
/*Route::resource('RidePostings', 'RidePostingsController');*/
Route::resource('BookPostings', 'BookPostingsController');
Route::resource('Messages', 'MessagesController');



Route::get('/', function()
{
	return View::make('hello');
});

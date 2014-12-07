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

Route::group(array('before' => 'cas'), function()
{
    Route::post('rides/addRequest', 'RideController@addRequest');
    Route::post('rides/addComment', 'RideController@addComment');
    Route::resource('rides', 'RideController');
    Route::resource('users', 'UserController');
});

Route::filter('cas', function()
{
    if (isset($_REQUEST['logout'])) {
        Cas::logout();
    } else {
        Cas::authenticate();
        $currentUser = User::firstOrNew(array('user_name' => Cas::getCurrentUser()));
        if (is_null($currentUser->email)) {
            $currentUser->email = $currentUser->user_name . '@students.wwu.edu';
            $currentUser->save();
        }
        if (is_null($currentUser->display_name)) {
            $currentUser->display_name = $currentUser->user_name;
            $currentUser->save();
        }
        View::share('currentUser', $currentUser);
    }
});

Route::get('/', function()
{
	return Redirect::to('rides');
});

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

Route::get('/', 'HomeController@getIndex');

// Profile routes
Route::bind('user', function($username) {
	if ($user = User::username($username)->first()) {
		return $user;
	}

	App::abort(404);
});
Route::get('member/{user}', array(
	'as'   => 'profile',
	'uses' => 'UserController@getProfile'
));

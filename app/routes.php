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

// User routes
Route::bind('user', function($username) {
	return User::username($username)->firstOrFail();
});
Route::get('member/{user}', array(
	'as'   => 'profile',
	'uses' => 'UserController@getProfile'
));
Route::get('signin',  array('as' => 'login',    'uses' => 'UserController@getLogin'));
Route::get('signout', array('as' => 'logout',   'uses' => 'UserController@getLogout'));
Route::get('signup',  array('as' => 'register', 'uses' => 'UserController@getRegister'));

// OAuth
Route::get('oauth/facebook/login', array('as' => 'facebook-login', 'uses' => 'OAuthController@getFacebookLogin'));

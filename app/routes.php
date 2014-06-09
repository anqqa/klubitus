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

// Session
Route::get('login',  array('as' => 'session.create',  'uses' => 'SessionController@create'));
Route::post('login', array('as' => 'session.store',   'uses' => 'SessionController@store'));
Route::get('logout', array('as' => 'session.destroy', 'uses' => 'SessionController@destroy'));

// OAuth
Route::get('oauth/facebook/login', array('as' => 'facebook-login', 'uses' => 'OAuthController@getFacebookLogin'));

// User
Route::bind('user', function($username) {
	return User::username($username)->firstOrFail();
});
Route::get('member/{user}',            array('as' => 'user.profile',   'uses' => 'UserController@getProfile'));
Route::get('member/{user?}/favorites', array('as' => 'user.favorites', 'uses' => 'UserController@getFavorites'));
Route::get('member/{user?}/friends',   array('as' => 'user.friends',   'uses' => 'UserController@getFriends'));
Route::get('member/{user?}/ignores',   array('as' => 'user.ignores',   'uses' => 'UserController@getIgnores'));
Route::get('member/{user?}/settings',  array('as' => 'user.settings',  'uses' => 'UserController@getSettings'));
Route::get('signup',  array('as' => 'register', 'uses' => 'UserController@getRegister'));

// Shouts
Route::controller('shouts', 'ShoutController');

// Forum
Route::get('messages', array('as' => 'forum.messages', 'users' => 'ForumController@getMessages'));

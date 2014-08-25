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

// API
Route::group([ 'prefix' => '/api/v2' ], function() {
			Route::resource('auth', 'SessionController');
//			Route::post('auth', 'SessionController@store');
//			Route::delete('auth', 'SessionController@destroy');

			Route::resource('newsfeed', 'NewsfeedController', [ 'only' => [ 'index' ]]);
			Route::resource('shouts', 'ShoutController', [ 'only' => [ 'index', 'store' ]]);
});

// AngularJS front-end
Route::any('{all}', function($uri) {
	return View::make('index');
})->where('all', '.*');



// Globals
Route::pattern('year', '[\d]{4}');
Route::pattern('month', '[01]?\d');
Route::pattern('day',  '[0-3]?\d');
Route::pattern('week', '[0-5]?\d');

// Home
Route::get('/', 'HomeController@getIndex');

// Session
Route::get('login',  array('as' => 'session.create',  'uses' => 'SessionController@create'));
Route::post('login', array('as' => 'session.store',   'uses' => 'SessionController@store'));
Route::get('logout', array('as' => 'session.destroy', 'uses' => 'SessionController@destroy'));

// OAuth
Route::get('oauth/facebook/login', array('as' => 'facebook-login', 'uses' => 'OAuthController@getFacebookLogin'));

// User
Route::bind('user', function($username) { return User::username($username)->firstOrFail(); });
Route::get('member/{user}',            array('as' => 'user.profile',   'uses' => 'UserController@getProfile'));
Route::get('member/{user?}/favorites', array('as' => 'user.favorites', 'uses' => 'UserController@getFavorites'));
Route::get('member/{user?}/friends',   array('as' => 'user.friends',   'uses' => 'UserController@getFriends'));
Route::get('member/{user?}/ignores',   array('as' => 'user.ignores',   'uses' => 'UserController@getIgnores'));
Route::get('member/{user?}/settings',  array('as' => 'user.settings',  'uses' => 'UserController@getSettings'));
Route::get('signup',  array('as' => 'register', 'uses' => 'UserController@getRegister'));

// Events
Route::bind('event', function($event) { return CalendarEvent::findOrFail((int)$event); });
Route::get('events/{year?}/{month?}/{day?}', array('as' => 'events',      'uses' => 'EventController@getIndex'));
Route::get('events/{year}/week/{week}',      array('as' => 'events.week', 'uses' => 'EventController@getIndex'));
Route::get('event/{event}',                  array('as' => 'event',       'uses' => 'EventController@getEvent'));

// Forum
Route::get('messages', array('as' => 'forum.messages', 'uses' => 'ForumController@getMessages'));

// Venues
Route::bind('venue', function ($venue) { return Venue::findOrFail((int)$venue); });
Route::get('venue/{venue}', array('as' => 'venue', 'uses' => 'VenueController@getVenue'));

// Shouts
Route::controller('shouts', 'ShoutController');


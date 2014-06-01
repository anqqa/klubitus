<?php

/**
 * Print username.
 */
HTML::macro('user', function($user = null, $username = null, $url = null) {
	static $viewer;

	// Load current user
	if ($viewer === null) {

	}

	$classes = array('user');
	if ($user) {

		// User
		$classes[] = 'hoverable';
		if (is_array($user)) {
			$gender   = $user['gender'];
			$userId   = $user['id'];
			$username = $user['username'];
		} else if ($user instanceof User) {
			$gender   = $user->gender;
			$userId   = $user->id;
			$username = $user->username;
		} else if (is_numeric($user)) {
			$userId = (int)$user;
			if ($user = User::find($userId)) {
				$gender   = $user->gender;
				$username = $user->username;
			} else {
				$gender   = '';
				$username = 'Unknown';
			}
		} else {
			$gender   = '';
			$userId   = 0;
			$username = 'Unknown';
		}

		switch ($gender) {
			case 'f': $classes[] = 'female'; break;
			case 'm': $classes[] = 'male'; break;
		}

		if (!$url) {
			$url = URL::route('profile', array('user' => Text::slug($username)));
		}

		return '<a href="' . $url . '" class="' . implode(' ', $classes) . '">' . e($username) . '</a>';

	} else {

		// Guest
		$classes[] = 'guest';
		if (!$username) {
			$username = 'Guest';
		}

		return '<span class="' . implode(' ', $classes) . '">' . e($username) . '</span>';

	}
});

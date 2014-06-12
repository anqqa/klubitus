<?php

/**
 * Form input.
 */
Form::macro('field', function($options) {

	// Name, required
	$name = array_pull($options, 'name');
	if (!$name) {
		return '';
	}

	/** @var  BaseForm  $form */
	$form = array_pull($options, 'form');

	// Type
	$type = array_pull($options, 'type', 'text');

	// Label
	$label = array_pull($options, 'label');

	// Value
	$value = null;
	if ($form) {
		$value = array_get($form->getInputData(), $name);
	}
	if ($value === null) {
		$value = Input::old($name, array_pull($options, 'value'));
	}

	// Class
	$class = array_pull($options, 'class');

	// Error
	$error = $form ? $form->getError($name) : null;;

	// Add other parameters to input
	$parameters = $options;
	$parameters['class'] = trim('form-control ' . $class);

	// Build markup
	$markup = '<div class="form-group' . ($error ? ' has-error' : '') . '">';

	switch ($type) {

		case 'text':
			if ($label) {
				$markup .= Form::label($name, $label, array('class' => 'control-label'));
			}
			$markup .= Form::input('text', $name, $value, $parameters);
			break;

		case 'checkbox':
			$markup .= '<div class="checkbox"><label>';
			$markup .= Form::checkbox($name, 1, (bool)$value);
			$markup .= ' ' . $label;
			$markup .= '</label></div>';
			break;

		case 'hidden':
			$markup = Form::hidden($name, $value);
			break;

		case 'password':
			$markup .= Form::label($name, $label, array('class' => 'control-label'));
			$markup .= Form::password($name, $parameters);
			break;

	}

	if ($error) {
		$markup .= '<span class="help-block">' . $error . '</span>';
	}

	if ($type !== 'hidden') {
		$markup .= '</div>';
	}

	return $markup;
});


/**
 * User avatar with link to profile.
 */
HTML::macro('avatar', function($avatar = true, $username = null, $class = null, $lazy = true) {
	static $viewer;

	// Load current user
	if ($viewer === null) {
		$viewer = Auth::user();
	}

	$placeholder = URL::asset('assets/img/avatar/unknown.png');
	$lazy        = $lazy && !Request::ajax();
	$class       = 'avatar ' . $class;

	// Gather missing data
	if (is_numeric($avatar)) {
		$avatar = User::findLight($avatar);
	}
	if ($avatar === true && $viewer) {

		// Use viewer by default
		$avatar   = $viewer->avatar;
		$username = $viewer->username;

	} else if (is_array($avatar)) {

		// Light user array
		$username = array_get($avatar, 'username', $username);
		$avatar   = array_get($avatar, 'avatar');

	} else if ($avatar instanceof User) {

		// User model
		$username = $avatar->username;
		$avatar   = $avatar->avatar;

	}


	// Missing
	if (!$avatar || strpos($avatar, '/') === false) {
		$avatar = $placeholder;
	}

	// Absolute
	if (strpos($avatar, '//') === false) {
		$avatar = URL::to($avatar);
	}

	if (!$username) {

		// Anonymous
		return '<span class="' . $class . '">' . ($lazy
			? HTML::image($placeholder, 'Avatar', [ 'class' => 'img-circle lazy', 'data-original' => $avatar ])
			: HTML::image($avatar, 'Avatar', [ 'class' => 'img-circle' ])
		) . '</span>';

	} else {

		// User
		$class = trim($class) . ' hoverable';
		$title = HTML::entities($username);

		return '<a href="' . URL::route('user.profile', [ 'user' => Text::slug($username) ]) . '" class="' . $class . '">' . ($lazy
			? HTML::image($placeholder, $title, [ 'title' => $title, 'class' => 'img-circle lazy', 'data-original' => $avatar ])
			: HTML::image($avatar, $title, [ 'title' => $title, 'class' => 'img-circle' ])
		) . '</a>';

	}
});


/**
 * Username with link to profile.
 */
HTML::macro('user', function($user = null, $username = null, $url = null) {
	static $viewer;

	// Load current user
	if ($viewer === null) {
		$viewer = Auth::user();
	}

	$classes = array('user');
	if ($user) {

		// User
		$classes[] = 'hoverable';
		$gender    = '';
		$userId    = 0;
		if (is_numeric($user) || is_string($user)) {
			$user = User::findLight($user);
		}
		if (is_array($user)) {
			$gender   = $user['gender'];
			$userId   = $user['id'];
			$username = $user['username'];
		} else if ($user instanceof User) {
			$gender   = $user->gender;
			$userId   = $user->id;
			$username = $user->username;
		} else {
			$username = 'Unknown';
		}

		switch ($gender) {
			case 'f': $classes[] = 'female'; break;
			case 'm': $classes[] = 'male'; break;
		}

		if (!$url) {
			$url = URL::route('user.profile', array('user' => Text::slug($username)));
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


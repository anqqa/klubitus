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

	// Type
	$type = array_pull($options, 'type', 'text');

	// Label
	$label = array_pull($options, 'label');

	// Value
	$value = Input::old($name, array_pull($options, 'value'));

	// Class
	$class = array_pull($options, 'class');

	// Error
	$form  = array_pull($options, 'form');
	$error = $form ? $form->getError($name) : null;;

	// Add other parameters to input
	$parameters = $options;
	$parameters['class'] = trim('form-control ' . $class);

	// Build markup
	$markup = '<div class="form-group' . ($error ? ' has-error' : '') . '">';

	switch ($type) {

		case 'text':
			$markup .= Form::label($name, $label, array('class' => 'control-label'));
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
 * Username with link to profile.
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
		} else if (is_numeric($user) || is_string($user)) {
			if ($user = User::findLight($user)) {
				$userId   = $user['id'];
				$gender   = $user['gender'];
				$username = $user['username'];
			} else {
				$userId   = 0;
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

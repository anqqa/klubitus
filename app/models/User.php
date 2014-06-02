<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'passwordhash', 'hash');


	/**
	 * Load one user light array
	 *
	 * @static
	 * @param   mixed  $id  User model, user array, user id, username
	 * @return  array|null
	 */
	public static function findLight($id = null) {
		if ($id instanceof User) {

			// Got user model, no need to load, just fill caches
			/** @var  User  $id */
			return $id->toLightArray();

		} else if (is_array($id)) {

			// Got user array, don't fill caches as we're not 100% sure it's valid
			return $id;

		} else if (is_int($id) || is_numeric($id)) {

			// Got an id
			$id = (int)$id;

		} else if (is_string($id)) {

			// Got user name, find id
			$id = self::user_id($id);

		} else {

			return null;

		}

		if ($id === 0) {
			return null;
		}

		return Cache::remember('userLight:' . $id, 60 * 24, function() use ($id) {
			return User::find($id)->toLightArray();
		});
	}


	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier() {
		return $this->getKey();
	}


	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword() {
		return $this->password;
	}


	/**
	 * Get user id from data
	 *
	 * @static
	 * @param   mixed  $user
	 * @return  integer
	 */
	public static function getId($user) {
		if (is_int($user) || is_numeric($user)) {

			// Already got id
			return (int)$user;

		} else if (is_array($user)) {

			// Got user array
			return (int)Arr::get($user, 'id');

		}	else if ($user instanceof User) {

			// Got user model
			return $user->id;

		} else if (is_string($user)) {

			// Got user name
			$username = Text::slug($user);
			if (!$id = (int)Cache::get('userName:' . $username)) {
				if ($user = User::find_user($user)) {
					$id = $user->id;
					Cache::put('userName:' . $username, $id, 60 * 24);
				}
			}

			return $id;
		}

		return 0;
	}


	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken() {
		return $this->remember_token;
	}


	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName() {
		return 'remember_token';
	}


	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail() {
		return $this->email;
	}


	/**
	 * Scope: latest.
	 *
	 * @param   \Illuminate\Database\Eloquent\Builder  $query
	 * @param   string                                 $username
	 * @return  \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeUsername(\Illuminate\Database\Eloquent\Builder $query, $username) {
		return $query->where('username_clean', '=', Text::slug($username));
	}


	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value) {
		$this->remember_token = $value;
	}


	/**
	 * Convert to light array.
	 *
	 * @return  array
	 */
	public function toLightArray() {
		if ($this->id) {
			return array(
				'id'           => (int)$this->id,
				'username'     => $this->username,
				'display_name' => $this->display_name,
				'gender'       => $this->gender,
				'title'        => $this->title,
				'signature'    => $this->signature,
				'avatar'       => $this->avatar,
//				'thumb'        => $this->get_image_url('thumbnail'),
				'last_login'   => (int)$this->last_login,
			);
		}

		return array();
	}


}

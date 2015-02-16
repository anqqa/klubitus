<?php
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Builder;


class User extends Eloquent
		implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	protected $table   = 'users';
	protected $visible = [
		'id',
		'adds',
		'avatar',
		'city_name',
		'comment_count',
		'created',
		'description',
		'display_name',
		'dob',
		'gender',
		'homepage',
		'last_login',
		'latitude',
		'left_comment_count',
		'longitude',
		'modified',
		'name',
		'post_count',
		'settings',
		'signature',
		'title',
		'username',
	];

	protected $hidden = array('password', 'passwordhash', 'hash');


	/**
	 * Load one user light array
	 *
	 * @static
	 * @param   mixed  $id  User model, user array, user id, username
	 * @return  array|null
	 */
	public static function findLight($id = null) {
		static $cache;

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
			$id = self::getId($id);

		} else {

			return null;

		}

		if ($id === 0) {
			return null;
		}

		if (!isset($cache[$id])) {
			$cache[$id] = Cache::remember('userLight:' . $id, 60 * 24, function() use ($id) {
				return User::find($id)->toLightArray();
			});
		}

		return $cache[$id];
	}


	/**
	 * User's friends.
	 *
	 * @return  \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function friends() {
		return $this->belongsToMany('User', 'friends', 'friend_id', 'user_id');
	}


	/**
	 * User's friends.
	 *
	 * @return  \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function friendsOf() {
		return $this->belongsToMany('User', 'friends', 'user_id', 'friend_id');
	}


	/**
	 * Get the unique identifier for the user.
	 *
	 * @return  mixed
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
	 * Get user id from data.
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
			return (int)array_get($user, 'id');

		}	else if ($user instanceof User) {

			// Got user model
			return $user->id;

		} else if (is_string($user)) {

			// Got user name
			$username = Text::slug($user);
			if (!$id = (int)Cache::get('userName:' . $username)) {
				if ($user = User::where('username_clean', '=', $username)->first()) {
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
	 * @param   Builder  $query
	 * @param   string   $username
	 * @return  Builder
	 */
	public function scopeUsername(Builder $query, $username) {
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

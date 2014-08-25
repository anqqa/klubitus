<?php
/**
 * Lighter user model for relationships.
 */
class UserLight extends Entity {
	protected $table   = 'users';
	protected $visible = [
			'id',
			'username',
			'display_name',
			'gender',
			'title',
			'signature',
			'avatar',
			'last_login'
	];

}

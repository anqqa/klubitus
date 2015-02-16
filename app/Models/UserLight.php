<?php namespace klubitus;

/**
 * Lighter user model for relationships.
 */
class UserLight extends Entity {
	protected $table   = 'users';
	protected $visible = [
		'id',
		'avatar',
		'display_name',
		'gender',
		'last_login',
		'signature',
		'title',
		'username',
	];

}

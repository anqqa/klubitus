<?php namespace klubitus\Models;

class Shout extends BaseModel {
	protected $table   = 'shouts';
	protected $visible = [ 'id', 'author_id', 'created', 'shout', 'user' ];


	public function user() {
		return $this->belongsTo('UserLight', 'author_id');
	}

}

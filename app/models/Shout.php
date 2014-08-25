<?php
/**
 * Shout model.
 */
class Shout extends Entity {
	protected $table   = 'shouts';
	protected $visible = [ 'id', 'author_id', 'created', 'shout', 'user' ];


//	public function author() {
//		return $this->belongsTo('User', 'author_id');
//	}


	public function user() {
		return $this->belongsTo('UserLight', 'author_id');
	}

}

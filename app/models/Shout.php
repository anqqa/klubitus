<?php
/**
 * Shout model.
 */
class Shout extends Entity {
	protected $table   = 'shouts';
	protected $visible = [ 'id', 'author_id', 'created_at', 'shout' ];
}

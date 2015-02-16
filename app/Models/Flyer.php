<?php namespace klubitus;

class Flyer extends Entity {
	protected $table   = 'flyers';
	protected $dates   = [ 'stamp_begin' ];
	protected $visible = [
			'id',
			'event',
			'event_id',
			'image',
			'image_id',
			'stamp_begin',
			'name',
	];


	/**
	 * Event.
	 *
	 * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function event() {
		return $this->belongsTo('CalendarEvent', 'event_id');
	}


	/**
	 * Image.
	 *
	 * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function image() {
		return $this->belongsTo('Image');
	}

}

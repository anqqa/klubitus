<?php
class Flyer extends Entity {
	protected $table = 'flyers';


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

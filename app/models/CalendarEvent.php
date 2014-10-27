<?php

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;


/**
 * Event model.
 */
class CalendarEvent extends Entity {
	protected $table   = 'events';
	//protected $dates   = [ 'begins_at', 'ends_at' ];
	protected $dates   = [ 'stamp_begin', 'stamp_end' ];
	protected $visible = [
		'id',
		'age',
		'city_name',
		'dj',
		'favorite_count',
		'favorites',
		'flyer',
		'flyer_id',
		'homepage',
		'music',
		'name',
		'price',
		'stamp_begin',
		'stamp_end',
		'start_date',
		'tickets_url',
		'venue',
		'venue_name',
		'venue_url',
	];


	public function favorites() {
		return $this->belongsToMany('User', 'favorites', 'event_id');
	}


	/**
	 * Main flyer.
	 *
	 * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function flyer() {
		return $this->belongsTo('Flyer');
	}


	/**
	 * Flyers.
	 *
	 * @return  \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function flyers() {
		return $this->hasMany('Flyer');
	}


	/**
	 * Start date in string format.
	 *
	 * @return  string
	 */
	public function getStartDateAttribute() {
		$begins_at = $this->stamp_begin->toDateString();

		if ($begins_at == date('Y-m-d')) {
			return 'Today';
		} else if ($begins_at == date('Y-m-d', strtotime('tomorrow'))) {
			return 'Tomorrow';
		} else if ($begins_at == date('Y-m-d', strtotime('yesterday'))) {
			return 'Yesterday';
		} else {
			return $this->stamp_begin->formatLocalized('%A, %d %B %Y');
		}
	}


	/**
	 * Venue.
	 *
	 * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function venue() {
		return $this->belongsTo('Venue');
	}

}

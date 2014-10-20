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


	/**
	 * Users who added this to favorites.
	 *
	 * @param   User   $onlyFriendsOf  Get only user's friends' favorites
	 * @return  array  user ids
	 */
	public function favorites(User $onlyFriendsOf = null) {
		$query = DB::table('favorites')
			->where('favorites.event_id', '=', $this->id)
			->select('favorites.user_id');

		if ($onlyFriendsOf) {
			$query
				->join('friends', 'friends.friend_id', '=', 'favorites.user_id')
				->where('friends.user_id', '=', $onlyFriendsOf->id);

			/*
			return $this->belongsToMany('User', 'favorites', 'event_id')
				->join('friends', 'friends.friend_id', '=', 'users.id')
				->where('friends.user_id', '=', $onlyFriendsOf->id);
			*/
		}

		return $query->lists('favorites.user_id');

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
	 * Scope: latest.
	 *
	 * @param   Builder  $query
	 * @param   Carbon   $from
	 * @param   Carbon   $to
	 * @return  Builder
	 */
	public function scopeRange(Builder $query, Carbon $from, Carbon $to) {
		return $query
			->where('begins_at', '<=', $to)
			->where('ends_at', '>=', $from->copy()->addHours(5)) // Only get after 5am
			->orderBy(DB::raw("date_trunc('day', begins_at)"), 'ASC')
			->orderBy('city_name', 'ASC');
	}


	/**
	 * Scope: week.
	 *
	 * @param   Builder         $query
	 * @param   Carbon|integer  $week
	 * @param   integer         $year
	 * @return  Builder
	 */
	public function scopeWeek(Builder $query, $week = null, $year = null) {
		if ($week instanceof Carbon) {
			$from = $week->startOfWeek();
		} else {
			$from = Carbon::create($year, 1, 1, 0, 0, 0)
				->addWeeks(($week ?: date('W')) - 1)
				->startOfWeek();
		}
		$to = $from->copy()->endOfWeek();

		return $this->scopeRange($query, $from, $to);
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

<?php

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;


/**
 * Event model.
 */
class CalendarEvent extends Entity {
	protected $table = 'events';
	protected $dates = [ 'begins_at', 'ends_at' ];


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
		$begins_at = $this->begins_at->toDateString();

		if ($begins_at == date('Y-m-d')) {
			return 'Today';
		} else if ($begins_at == date('Y-m-d', strtotime('tomorrow'))) {
			return 'Tomorrow';
		} else if ($begins_at == date('Y-m-d', strtotime('yesterday'))) {
			return 'Yesterday';
		} else {
			return $this->begins_at->formatLocalized('%A, %d %B %Y');
		}
	}


	/**
	 * Scope: day.
	 *
	 * @param   Builder         $query
	 * @param   Carbon|integer  $day
	 * @param   integer         $month
	 * @param   integer         $year
	 * @return  Builder
	 */
	public function scopeDay(Builder $query, $day = null, $month = null, $year = null) {
		if ($day instanceof Carbon) {
			$from = $day->startOfDay();
		} else {
			$from = Carbon::create($year, $month, $day, 0, 0, 0);
		}
		$to = $from->copy()->endOfDay();

		return $this->scopeRange($query, $from, $to);
	}


	/**
	 * Scope: month.
	 *
	 * @param   Builder         $query
	 * @param   Carbon|integer  $month
	 * @param   integer         $year
	 * @return  Builder
	 */
	public function scopeMonth(Builder $query, $month = null, $year = null) {
		if ($month instanceof Carbon) {
			$from = $month->startOfMonth();
		} else {
			$from = Carbon::create($year, $month, 1, 0, 0, 0);
		}
		$to = $from->copy()->endOfMonth();

		return $this->scopeRange($query, $from, $to);
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

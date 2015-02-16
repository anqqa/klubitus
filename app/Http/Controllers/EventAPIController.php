<?php namespace klubitus\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class EventAPIController extends BaseAPIController {

	/** @var  CalendarEventRepository */
	protected $events;


	/**
	 * @param  CalendarEventRepository  $events
	 */
	public function __construct(CalendarEventRepository $events) {
		$this->events = $events;
	}


	/**
	 * API: Events by day.
	 *
	 * @return  Collection
	 */
	public function getByDay() {
		$year  = (int)Route::input('year');
		$month = (int)Route::input('month');
		$day   = (int)Route::input('day');

		try {
			return $this->loadRelationships($this->events->getByDate($year, $month, $day));
		} catch (Exception $e) {
			throw new BadRequestHttpException($e->getMessage());
		}
	}


	/**
	 * API: Events by month.
	 *
	 * @return  Collection
	 */
	public function getByMonth() {
		$year  = (int)Route::input('year');
		$month = (int)Route::input('month');

		try {
			return $this->loadRelationships($this->events->getByDate($year, $month));
		} catch (Exception $e) {
			throw new BadRequestHttpException($e->getMessage());
		}
	}


	/**
	 * API: Events by year.
	 *
	 * @return  Collection
	 */
	public function getByYear() {
		$year = (int)Route::input('year');

		try {
			return $this->loadRelationships($this->events->getByDate($year));
		} catch (Exception $e) {
			throw new BadRequestHttpException($e->getMessage());
		}
	}


	/**
	 * API: Events by year.
	 *
	 * @return  Collection
	 */
	public function getByWeek() {
		$year = (int)Route::input('year');
		$week = (int)Route::input('week');

		try {
			return $this->loadRelationships($this->events->getByWeek($year, $week));
		} catch (Exception $e) {
			throw new BadRequestHttpException($e->getMessage());
		}
	}


	/**
	 * Lazy eager loading or relationships.
	 *
	 * @param   Collection  $events
	 * @return  Collection
	 */
	protected function loadRelationships(Collection $events) {
		$with = explode(',', Input::get('with'));

		if (in_array('favorites', $with)) {
			$events->load('favorites');
		}
		else if (in_array('friend_favorites', $with) && Auth::user()) {
			$events->load([ 'favorites' => function($query) {
						$query
							->join('friends', 'friends.friend_id', '=', 'favorites.user_id')
							->where('friends.user_id', '=', Auth::user()->id);
					}]);
		}

		if (in_array('flyer', $with)) {
			$events->load('flyer', 'flyer.image');
		}

		if (in_array('venue', $with)) {
			$events->load('venue');
		}

		return $events;
	}

}

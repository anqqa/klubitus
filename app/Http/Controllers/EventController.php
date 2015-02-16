<?php namespace klubitus\Http\Controllers;

use Carbon\Carbon;

class EventController extends BaseController {
	protected $id = 'events';


	/**
	 * Event.
	 *
	 * @param  CalendarEvent  $event
	 */
	public function getEvent(CalendarEvent $event) {

	}


	/**
	 * Index.
	 */
	public function getIndex() {
		$year  = Route::input('year');
		$month = Route::input('month');
		$day   = Route::input('day');
		$week  = Route::input('week');
		$date  = Carbon::create($year, $month, $day);

		if ($day) {
			$range = 'day';
		} else if ($month) {
			$range = 'month';
		} else if ($week) {
			$range = 'week';
			$date  = $date->startOfYear()->addWeeks($week - 1);
		} else if ($year) {
			$range = 'year';
		} else {
			$range = 'week';
		}

		$this->layout->content = View::make('layouts._right_sidebar', array(
			'content' => $this->viewEvents($date, $range),
			'sidebar' => $this->viewCalendar($date)
		));
	}


	/**
	 * Sidebar calendar view.
	 *
	 * @param   Carbon  $date
	 * @return  string
	 */
	protected function viewCalendar(Carbon $date) {
		$calendar = new Calendar($date);

		return View::make('events.calendar', array(
					'calendar' => $calendar
				))->render();
	}


	/**
	 * Big events list view.
	 *
	 * @param   Carbon  $date
	 * @param   string  $range
	 * @return  string
	 */
	protected function viewEvents(Carbon $date, $range = 'week') {
		$relationships = 'flyer,friend_favorites,venue';

		switch ($range) {

			case 'day':
				$events = $this->api->get(
						sprintf('events/%d/%d/%d?with=%s',
						$date->year, $date->month, $date->day, $relationships)
				);
				break;

			case 'week':
				$events = $this->api->get(
						sprintf('events/%d/week/%d?with=%s',
						$date->year, $date->weekOfYear, $relationships)
				);
				break;

			case 'month':
				$events = $this->api->get(
						sprintf('events/%d/%d?with=%s',
						$date->year, $date->month, $relationships)
				);
				break;

			default:
				return '';
		}

		return View::make('events.index', array(
			'events' => $events
		))->render();
	}

}

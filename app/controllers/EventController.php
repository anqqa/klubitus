<?php

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
			'sidebar' => ''
		));
	}


	/**
	 * Big events list view.
	 *
	 * @return  \Illuminate\View\View
	 */
	protected function viewEvents(Carbon $date, $range = 'week') {
		switch ($range) {
			case 'day':   $events = CalendarEvent::day($date); break;
			case 'week':  $events = CalendarEvent::week($date); break;
			case 'month': $events = CalendarEvent::month($date); break;
			default:      return '';
		}

		return View::make('events.index', array(
			'events' => $events->get(),
		));
	}

}

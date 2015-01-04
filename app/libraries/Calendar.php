<?php
use Carbon\Carbon;

class Calendar {

	/** @var  Carbon */
	private $date;

	/** @var  Carbon */
	private $today;


	/**
	 * @param  Carbon  $date
	 */
	public function __construct(Carbon $date) {
		$this->today = Carbon::today();

		$this->date  = $date;
	}


	/**
	 * @return  Carbon
	 */
	public function getDate() {
		return $this->date;
	}


	/**
	 * @return  string
	 */
	public function getNextLink() {
		$month = $this->date->copy()->addMonth();

		return URL::route('events', [
					'year'  => $month->year,
					'month' => $month->month
				]);
	}


	/**
	 * @return  string
	 */
	public function getPreviousLink() {
		$month = $this->date->copy()->subMonth();

		return URL::route('events', [
					'year'  => $month->year,
					'month' => $month->month
				]);
	}


	/**
	 * Build weeks array.
	 *
	 * @return  array
	 */
	public function getWeeks() {
		$weeks = array();

		/** @var  Carbon  $firstDay */
		$firstDay = $this->date->copy()->firstOfMonth();

		/** @var  Carbon  $firstMonday */
		$firstMonday = $firstDay->dayOfWeek == Carbon::MONDAY
				? $firstDay->copy()
				: $firstDay->copy()->previous(Carbon::MONDAY);

		/** @var  Carbon  $lastDay */
		$lastDay = $this->date->copy()->lastOfMonth();

		$totalWeeks = $firstDay->diffInWeeks($lastDay) + 1;

		for ($week = 0; $week < $totalWeeks; $week++) {
			$weeks[$week] = array();

			for ($day = 0; $day < 7; $day++) {
				$date = $firstMonday->copy()->addDays($week * 7 + $day);

				$classes = [];
				if ($date->isToday()) {
					$classes[] = 'today active';
				}
				if ($date->month != $this->date->month) {
					$classes[] = 'disabled';
				}

				$weeks[$week][$day] = [
						'date'    => $date,
						'classes' => $classes
				];
			}
		}

		return $weeks;
	}

}

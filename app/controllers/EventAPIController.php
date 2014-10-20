<?php
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
			return $this->events->getByDate($year, $month, $day);
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
			return $this->events->getByDate($year, $month);
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
			return $this->events->getByDate($year);
		} catch (Exception $e) {
			throw new BadRequestHttpException($e->getMessage());
		}
	}

}

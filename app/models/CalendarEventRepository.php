<?php
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class CalendarEventRepository extends EloquentRepository {

	/**
	 * @param  CalendarEvent  $model
	 */
	public function __construct(CalendarEvent $model) {
		$this->model = $model;
	}


	/**
	 * Get events by date.
	 *
	 * E.g. set year and month as int or just month as Carbon to get by month.
	 *
	 * @param   Carbon|integer  $year
	 * @param   Carbon|integer  $month
	 * @param   Carbon|integer  $day
	 * @return  Collection
	 *
	 * @throws  Exception  On invalid parameters
	 */
	public function getByDate($year = null, $month = null, $day = null) {
		if ($day) {

			// Get by day
			if ($day instanceof Carbon) {
				$from = $day->copy();
			}
			else if ($month && $year) {
				$from = Carbon::create($year, $month, $day);
			}
			else {
				throw new Exception('Month or year missing');
			}
			$to = $from->copy();

		}
		else if ($month) {

			// Get by month
			if ($month instanceof Carbon) {
				$from = $month->copy()->startOfMonth();
			}
			else if ($year) {
				$from = Carbon::create($year, $month, 1);
			}
			else {
				throw new Exception('Year missing');
			}
			$to = $from->copy()->endOfMonth();

		}
		else if ($year) {

			// Get by year
			if ($year instanceof Carbon) {
				$from = $year->copy()->startOfYear();
			}
			else {
				$from = Carbon::create($year, 1, 1);
			}
			$to = $from->copy()->endOfYear();

		}
		else {
			throw new Exception('Year, month or day missing');
		}

		return $this->getByRange($from->startOfDay(), $to->endOfDay());
	}


	/**
	 * Scope: latest.
	 *
	 * @param   Carbon   $from
	 * @param   Carbon   $to
	 * @return  Collection
	 */
	public function getByRange(Carbon $from, Carbon $to) {
		return $this->model
				->where('begins_at', '<=', $to)
				->where('ends_at', '>=', $from->copy()->addHours(5)) // Only get after 5am
				->orderBy(DB::raw("date_trunc('day', begins_at)"), 'ASC')
				->orderBy('city_name', 'ASC')
				->get();
	}

}

<?php namespace klubitus;

use Illuminate\Database\Eloquent\Collection;


class ShoutRepository extends EloquentRepository {

	/**
	 * @param  Shout  $model
	 */
	public function __construct(Shout $model) {
		$this->model = $model;
	}


	/**
	 * Get latest models.
	 *
	 * @param   integer  $count
	 * @return  Collection
	 */
/*
	public function getLatest($count) {
		return $this->model->with('user')
		                   ->orderBy('id', 'desc')
		                   ->take($count)
		                   ->get();
	}
*/
}

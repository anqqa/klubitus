<?php
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
	 * @return  \Illuminate\Database\Eloquent\Collection
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

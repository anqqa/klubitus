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
	 * @param   string   $column
	 * @return  \Illuminate\Database\Eloquent\Collection
	 */
	public function getLatest($count, $column = 'id') {
		return $this->model->with('user')
		                   ->orderBy($column, 'desc')
		                   ->take($count)
		                   ->get();
	}

}

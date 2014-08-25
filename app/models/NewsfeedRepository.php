<?php
class NewsfeedRepository extends EloquentRepository {

	/**
	 * @param  NewsfeedItem  $model
	 */
	public function __construct(NewsfeedItem $model) {
		$this->model = $model;
	}


	/**
	 * Get latest models.
	 *
	 * @param   integer  $count
	 * @return  \Illuminate\Database\Eloquent\Collection
	 */
/*	public function getLatest($count) {
		return $this->model->with('user')
		                   ->orderBy('id', 'desc')
		                   ->take($count)
		                   ->get();
	}*/

}

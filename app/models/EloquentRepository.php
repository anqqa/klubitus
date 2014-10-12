<?php
use \Illuminate\Database\Eloquent\Collection;


/**
 * Class EloquentRepository.
 *
 * Eloquent model repository.
 */
abstract class EloquentRepository {

	/** @var  Eloquent */
	protected $model;


	/**
	 * Construct repository.
	 *
	 * @param  Eloquent  $model
	 */
	public function __construct(Eloquent $model = null) {
		$this->model = $model;
	}


	/**
	 * Delete model.
	 *
	 * @param   Eloquent  $model
	 * @return  boolean
	 * @throws  Exception
	 */
	public function delete(Eloquent $model) {
		return $model->delete();
	}


	/**
	 * Get all models from repository.
	 *
	 * @return  Collection
	 */
	public function getAll() {
		return $this->model->all();
	}


	/**
	 * Get model by id.
	 *
	 * @param   mixed  $id
	 * @return  Eloquent
	 */
	public function getById($id) {
		return $this->model->find($id);
	}


	/**
	 * Get latest models.
	 *
	 * @param   $count
	 * @param   string  $column
	 * @param   array   $with    Relationships
	 * @return  Collection
	 */
	public function getLatest($count, $column = 'id', $with = []) {
		$query = $this->model->orderBy($column, 'desc');

		if ($with) {
			$query = $query->with($with);
		}

		return $query->take($count)->get();
	}


	/**
	 * Get repository model.
	 *
	 * @return  \Eloquent
	 */
	public function getModel() {
		return $this->model;
	}


	/**
	 * Create new model.
	 *
	 * @param   array  $attributes
	 * @return  Eloquent
	 */
	public function getNew($attributes = array()) {
		return $this->model->newInstance($attributes);
	}


	/**
	 * Save model.
	 *
	 * @param   Eloquent|array  $data
	 * @return  boolean
	 */
	public function save($data) {
		if ($data instanceof Eloquent) {
			return $this->storeEloquent($data);
		} elseif (is_array($data)) {
			return $this->storeArray($data);
		}

		return null;
	}


	/**
	 * Set repository model.
	 *
	 * @param  Eloquent  $model
	 */
	public function setModel(Eloquent $model) {
		$this->model = $model;
	}


	/**
	 * Save model using array of attributes.
	 *
	 * @param   array  $data
	 * @return  boolean
	 */
	protected function storeArray(array $data) {
		$model = $this->getNew($data);

		return $this->storeEloquent($model);
	}


	/**
	 * Save model.
	 *
	 * @param   Eloquent  $model
	 * @return  boolean
	 */
	protected function storeEloquent(Eloquent $model) {
		if ($model->getDirty()) {

			// Attributes changed
			return $model->save();

		} else {

			// No attributes changed, just update stamp
			return $model->touch();

		}
	}

}


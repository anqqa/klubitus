<?php namespace klubitus\Repositories;

use Illuminate\Database\Eloquent\Collection;
use klubitus\Exceptions\EntityNotFoundException;
use klubitus\Exceptions\EntityNotUpdatedException;
use klubitus\Exceptions\ModelNotFoundException;
use klubitus\Models\BaseModel;


abstract class BaseRepository implements BaseRepositoryInterface {

	/** @var  BaseModel */
	protected $model;

	/** @var  string */
	protected $modelFolder = 'Models';

	/** @var  string */
	protected $modelName;


	/**
	 * @throws  ModelNotFoundException
	 */
	public function __construct() {
		if (!$this->modelName) {
			$this->setModelName();
		}

		if (!class_exists($this->modelName)) {
			throw new ModelNotFoundException('Model [' . $this->modelName . '] does not exist.');
		}

		$this->model = new $this->modelName();
	}


	/**
	 * Create new entity.
	 *
	 * @param   array  $data
	 * @return  BaseModel
	 */
	public function create(array $data) {
		return $this->model->create($data);
	}


	/**
	 * Delete an entity.
	 *
	 * @param   integer  $id
	 * @return  boolean
	 * @throws  EntityNotFoundException
	 */
	public function delete($id) {
		return $this->findOrFail($id)->delete();
	}


	/**
	 * Find an entity by id.
	 *
	 * @param   integer  $id
	 * @return  BaseModel
	 */
	public function find($id) {
		return $this->model->find($id);
	}


	/**
	 * Find all entities.
	 *
	 * @param   array    $orderBy
	 * @param   integer  $limit
	 * @return  mixed
	 */
	public function findAll(array $orderBy = ['id', 'asc'], $limit = 0) {
		return $this->model
				->orderBy($orderBy[0], $orderBy[1])
				->take($limit)
				->get();
	}


	/**
	 * Find all entities by column value.
	 *
	 * @param   string  $column
	 * @param   mixed   $value
	 * @param   array   $orderBy
	 * @param   integer  $limit
	 * @return  Collection
	 */
	public function findAllBy($column, $value, array $orderBy = ['id', 'asc'], $limit = 0) {
		return $this->model
				->where($column, $value)
				->orderBy($orderBy[0], $orderBy[1])
				->take($limit)
				->get();
	}


	/**
	 * Find an entity by column value.
	 *
	 * @param   string  $column
	 * @param   mixed   $value
	 * @return  BaseModel
	 */
	public function findBy($column, $value) {
		return $this->model->where($column, $value)->first();
	}


	/**
	 * Find an entity by id or fail.
	 *
	 * @param   integer  $id
	 * @return  BaseModel
	 * @throws  EntityNotFoundException
	 */
	public function findOrFail($id) {
		if (!$entity = $this->find($id)) {
			throw new EntityNotFoundException('Entity [' . $id . '] does not exist.');
		}

		return $entity;
	}


	/**
	 * Find an entity by column value.
	 *
	 * @param   string  $column
	 * @param   mixed   $value
	 * @return  mixed
	 * @throws  \klubitus\Exceptions\EntityNotFoundException
	 */
	public function findOrFailBy($column, $value) {
		if (!$entity = $this->findBy($column, $value)) {
			throw new EntityNotFoundException('Entity does not exist.');
		}

		return $entity;
	}


	/**
	 * Set model class based on repository.
	 */
	protected function setModelName() {
		$repositoryName = explode('\\', get_called_class());
		$modelFolder    = $this->modelFolder ? '\\' . $this->modelFolder . '\\' : '\\';

		$this->modelName = $repositoryName[0] . $modelFolder . str_replace('Repository', '', end($repositoryName));
	}


	/**
	 * Update an entity.
	 *
	 * @param   integer  $id
	 * @param   array    $data
	 * @return  BaseModel
	 * @throws  EntityNotFoundException|EntityNotUpdatedException
	 */
	public function update($id, array $data) {
		if ($this->findOrFail($id)->update($data)) {
			return $this->findOrFail($id);
		}

		throw new EntityNotUpdatedException('Entity [' . $id . '] could not be updated.');
	}
}


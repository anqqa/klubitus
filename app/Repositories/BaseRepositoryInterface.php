<?php namespace klubitus\Repositories;

interface BaseRepositoryInterface {

	/**
	 * Create new entity.
	 *
	 * @param   array  $data
	 * @return  mixed
	 */
	public function create(array $data);


	/**
	 * Delete an entity.
	 *
	 * @param   integer  $id
	 * @return  boolean
	 * @throws  \klubitus\Exceptions\EntityNotFoundException
	 */
	public function delete($id);


	/**
	 * Find an entity by id.
	 *
	 * @param   int  $id
	 * @return  mixed
	 */
	public function find($id);


	/**
	 * Find all entities.
	 *
	 * @param   array    $orderBy
	 * @param   integer  $limit
	 * @return  mixed
	 */
	public function findAll(array $orderBy = ['id', 'asc'], $limit = 0);


	/**
	 * Find all entities by column value.
	 *
	 * @param   string   $column
	 * @param   mixed    $value
	 * @param   array    $orderBy
	 * @param   integer  $limit
	 * @return  mixed
	 */
	public function findAllBy($column, $value, array $orderBy = ['id', 'asc'], $limit = 0);


	/**
	 * Find an entity by column value.
	 *
	 * @param   string  $column
	 * @param   mixed   $value
	 * @return  mixed
	 */
	public function findBy($column, $value);


	/**
	 * Find an entity by id or fail.
	 *
	 * @param   int  $id
	 * @return  mixed
	 * @throws  \klubitus\Exceptions\EntityNotFoundException
	 */
	public function findOrFail($id);


	/**
	 * Find an entity by column value.
	 *
	 * @param   string  $column
	 * @param   mixed   $value
	 * @return  mixed
	 * @throws  \klubitus\Exceptions\EntityNotFoundException
	 */
	public function findOrFailBy($column, $value);


	/**
	 * Update an entity.
	 *
	 * @param   integer  $id
	 * @param   array    $data
	 * @return  mixed
	 * @throws  \klubitus\Exceptions\EntityNotFoundException|\klubitus\Exceptions\EntityNotUpdatedException
	 */
	public function update($id, array $data);

}

<?php

class EventedmemcachedStore extends Illuminate\Cache\MemcachedStore {

	/**
	 * Remove an item from the cache.
	 *
	 * @param  string  $key
	 * @return void
	 */
	public function forget($key) {
		parent::forget($key);

		Event::fire('cache.forget', $key);
	}


	/**
	 * Retrieve an item from the cache by key.
	 *
	 * @param   string  $key
	 * @return  mixed
	 */
	public function get($key) {
		$value = parent::get($key);

		Event::fire(is_null($value) ? 'cache.get.miss' : 'cache.get.hit', $key);

		return $value;
	}


	/**
	 * Store an item in the cache for a given number of minutes.
	 *
	 * @param   string   $key
	 * @param   mixed    $value
	 * @param   integer  $minutes
	 * @return  void
	 */
	public function put($key, $value, $minutes) {
		parent::put($key, $value, $minutes);

		Event::fire('cache.put', $key);
	}

}


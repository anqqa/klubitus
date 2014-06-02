<?php

use Illuminate\Support\ServiceProvider;

class KohanaHashServiceProvider extends ServiceProvider {

	/**
	 * Services provided by provider.
	 *
	 * @return  array
	 */
	public function provides() {
		return array('hash');
	}


	/**
	 * Register service provider.
	 */
	public function register() {
		$this->app->bindShared('hash', function() { return new KohanaHasher; });
	}

}


angular
		.module('klubitusApp')
		.factory('Auth', function($resource) {
			return $resource('/api/v2/auth/');
		});

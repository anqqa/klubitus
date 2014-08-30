angular
		.module('klubitusApp')
		.factory('Auth', function($resource) {
			var auth = $resource('/api/v2/auth/');

			return auth;
		});

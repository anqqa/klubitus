angular
		.module('klubitusApp')
		.factory('Newsfeed', function($resource) {
			return $resource('/api/v2/newsfeed/:user_id', {}, {
				latest: { method: 'GET', isArray: true }
			})
		});

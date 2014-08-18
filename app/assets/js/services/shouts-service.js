angular
		.module('klubitusApp')
		.factory('Shouts', function($resource) {
			return $resource('/api/v2/shouts/:id', {}, {
				latest: { method: 'GET', isArray: true },
				add:    { method: 'POST' }
			})
		});

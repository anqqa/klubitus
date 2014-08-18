angular
		.module('klubitusApp')
		.filter('toDate', function() {
			return function(input) {
				return new Date(input);
			}
		});

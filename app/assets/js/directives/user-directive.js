angular
		.module('klubitusApp')
		.directive('klubitusUser', function() {
			return {
				replace:     true,
				restrict:    'E',
				scope:       { user: '=' },
				templateUrl: 'assets/templates/user.html'
			}
		});

angular
		.module('klubitusApp')
		.directive('klubitusShouts', function(Shouts) {
			return {
				replace:     true,
				restrict:    'E',
				scope:       {},
				templateUrl: 'assets/templates/shouts.html',

				link: function($scope, $elem) {

					// Send shout
					$scope.save = function() {

					};

					$scope.shouts = Shouts.latest({ limit: 10 });
				}
			}
		});

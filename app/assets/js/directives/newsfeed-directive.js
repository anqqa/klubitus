angular
		.module('klubitusApp')
		.directive('klubitusNewsfeed', function(Newsfeed) {
			return {
				replace:     true,
				restrict:    'E',
				scope:       { user: '=' },
				templateUrl: 'assets/templates/newsfeed.html',

				link: function($scope, $elem) {
					$scope.newsfeed = Newsfeed.latest({
						limit:   50,
						user_id: $scope.user ? $scope.user.id : null
					});
				}
			}
		});

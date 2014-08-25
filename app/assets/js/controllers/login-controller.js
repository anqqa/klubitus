angular
		.module('klubitusApp')
		.controller('LoginController', function($scope, $sanitize, Auth) {

			// Alerts
			$scope.alerts = [];
			$scope.closeAlert = function(index) {
				$scope.alerts.splice(index, 1);
			};

			// Login
			$scope.user  = { remember: true };
			$scope.login = function() {
				Auth.save({
					'username': $sanitize($scope.user.username),
					'password': $sanitize($scope.user.password),
					'remember': $scope.user.remember
				},
				function() {

					// Success
					console.log('yay!');

				},
				function(response) {

					// Error
					console.dir(response);

					$scope.alerts = [{ type: 'warning', msg: response.data.message }];

				});
				console.dir($scope.user);
			}
		});

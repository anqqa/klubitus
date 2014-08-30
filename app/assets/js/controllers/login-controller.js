angular
		.module('klubitusApp')
		.controller('LoginController', function($rootScope, $scope, $localStorage, Auth) {
			$rootScope.authenticated = !!$localStorage.user;

			// Alerts
			$scope.alerts = [];
			$scope.closeAlert = function(index) {
				$scope.alerts.splice(index, 1);
			};

			// Login
			$scope.user  = { remember: true };
			$scope.login = function() {
				Auth.save({
							'username': $scope.user.username,
							'password': $scope.user.password,
							'remember': $scope.user.remember
						},
						function(response) {

							// Success
							$localStorage.user = response.user;
							$rootScope.authenticated = true;

						},
						function(response) {

							// Error
							console.dir(response);

							$scope.alerts = [{ type: 'warning', msg: response.data.message }];

						});
			};

			// Logout
			$scope.logout = function() {
				Auth.delete({});

				delete $localStorage.user;
				$rootScope.authenticated = false;
			};

		});

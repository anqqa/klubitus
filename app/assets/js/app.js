var klubitusApp = angular
		.module('klubitusApp', [
			'ngResource',
			'ngRoute',
			'ngSanitize',
			'ngStorage',
			'ui.bootstrap',
			'ui.router'
		])

		// Routes
		.config(function($locationProvider, $stateProvider, $urlRouterProvider) {

			// HTML5 urls without hashbang
			$locationProvider.html5Mode(true);

			$urlRouterProvider.otherwise('/');

			$stateProvider
					.state('home', {
						url:         '/',
						templateUrl: 'assets/templates/home.html',
						controller:  'HomeController'
					});

		})

		// Logout when response is Not Authorized
		.config(function($httpProvider) {
			var interceptor = function($rootScope, $location, $q, Flash) {
				var success = function(response) {
					return response;
				};

				var error = function(response) {
					if (response.status = 401) {
						delete sessionStorage.authenticated;

						$location.path('/');

						Flash.show(response.data.flash);
					}

					return $q.reject(response);
				};

				return function(promise) {
					return promise.then(success, error);
				}
			};

			//$httpProvider.responseInterceptors.push(interceptor);
		})

		.run(function($rootScope, $http, CSRF_TOKEN) {
			$http.defaults.headers.common['csrf_token'] = CSRF_TOKEN;
		});

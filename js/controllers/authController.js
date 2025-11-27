collegeHubApp.controller('AuthController', ['$scope', '$location', 'ApiService', function($scope, $location, ApiService) {
    $scope.isLoggedIn = false;
    $scope.userName = '';

    $scope.checkSession = function() {
        ApiService.checkSession().then(function(response) {
            if (response.data.logged_in) {
                $scope.isLoggedIn = true;
                $scope.userName = response.data.user_name;
            } else {
                $scope.isLoggedIn = false;
            }
        });
    };

    $scope.logout = function() {
        ApiService.logout().then(function(response) {
            $scope.isLoggedIn = false;
            $scope.userName = '';
            $location.path('/home');
        });
    };

    $scope.checkSession();
}]);

collegeHubApp.controller('LoginController', ['$scope', '$location', 'ApiService', function($scope, $location, ApiService) {
    $scope.loginData = {};
    $scope.message = '';

    $scope.login = function() {
        if (!$scope.loginData.email || !$scope.loginData.password) {
            $scope.message = 'Please fill in all fields';
            return;
        }

        ApiService.login($scope.loginData).then(function(response) {
            if (response.data.status === 'success') {
                $scope.message = 'Login successful!';
                setTimeout(function() {
                    $location.path('/home');
                    $scope.$apply();
                }, 1000);
            } else {
                $scope.message = response.data.message;
            }
        }, function(error) {
            $scope.message = 'An error occurred. Please try again.';
        });
    };
}]);

collegeHubApp.controller('RegisterController', ['$scope', '$location', 'ApiService', function($scope, $location, ApiService) {
    $scope.registerData = {};
    $scope.message = '';

    $scope.register = function() {
        if (!$scope.registerData.name || !$scope.registerData.email || !$scope.registerData.phone || !$scope.registerData.password || !$scope.registerData.confirm_password) {
            $scope.message = 'Please fill in all fields';
            return;
        }

        ApiService.register($scope.registerData).then(function(response) {
            if (response.data.status === 'success') {
                $scope.message = 'Registration successful! Redirecting to login...';
                setTimeout(function() {
                    $location.path('/login');
                    $scope.$apply();
                }, 1500);
            } else {
                $scope.message = response.data.message;
            }
        }, function(error) {
            $scope.message = 'An error occurred. Please try again.';
        });
    };
}]);

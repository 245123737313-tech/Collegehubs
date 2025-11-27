var collegeHubApp = angular.module('collegeHubApp', ['ngRoute']);

collegeHubApp.config(['$routeProvider', function($routeProvider) {
    $routeProvider
        .when('/home', {
            templateUrl: 'views/home.html',
            controller: 'HomeController'
        })
        .when('/notices', {
            templateUrl: 'views/notices.html',
            controller: 'NoticesController'
        })
        .when('/lostfound', {
            templateUrl: 'views/lostfound.html',
            controller: 'LostFoundController'
        })
        .when('/studymaterials', {
            templateUrl: 'views/studyMaterials.html',
            controller: 'StudyMaterialsController'
        })
        .when('/login', {
            templateUrl: 'views/login.html',
            controller: 'LoginController'
        })
        .when('/register', {
            templateUrl: 'views/register.html',
            controller: 'RegisterController'
        })
        .otherwise({
            redirectTo: '/home'
        });
}]);

collegeHubApp.controller('HomeController', ['$scope', function($scope) {
    $scope.pageTitle = 'Welcome to College Hub';
}]);

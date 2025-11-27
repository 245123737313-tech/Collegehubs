collegeHubApp.controller('NoticesController', ['$scope', 'ApiService', function($scope, ApiService) {
    $scope.notices = [];
    $scope.newNotice = {};
    $scope.message = '';
    $scope.showForm = false;
    $scope.isLoggedIn = false;

    $scope.checkLogin = function() {
        ApiService.checkSession().then(function(response) {
            $scope.isLoggedIn = response.data.logged_in;
        });
    };

    $scope.fetchNotices = function() {
        ApiService.fetchNotices().then(function(response) {
            if (response.data.status === 'success') {
                $scope.notices = response.data.data;
            }
        }, function(error) {
            console.log('Error fetching notices:', error);
        });
    };

    $scope.addNotice = function() {
        if (!$scope.isLoggedIn) {
            $scope.message = 'Please login to post a notice';
            $scope.showForm = false;
            return;
        }

        if (!$scope.newNotice.title || !$scope.newNotice.description) {
            $scope.message = 'Please fill in all fields';
            return;
        }

        ApiService.addNotice($scope.newNotice).then(function(response) {
            if (response.data.status === 'success') {
                $scope.message = 'Notice added successfully!';
                $scope.newNotice = {};
                $scope.showForm = false;
                $scope.fetchNotices();
            } else {
                $scope.message = response.data.message;
            }
        }, function(error) {
            $scope.message = 'An error occurred. Please try again.';
        });
    };

    $scope.deleteNotice = function(noticeId) {
        if (confirm('Are you sure you want to delete this notice?')) {
            ApiService.deleteNotice(noticeId).then(function(response) {
                if (response.data.status === 'success') {
                    $scope.message = 'Notice deleted successfully!';
                    setTimeout(function() {
                        $scope.$apply(function() {
                            $scope.fetchNotices();
                        });
                    }, 300);
                } else {
                    $scope.message = response.data.message;
                }
            }, function(error) {
                $scope.message = 'Error deleting notice';
                console.log('Delete error:', error);
            });
        }
    };

    $scope.checkLogin();
    $scope.fetchNotices();
}]);

collegeHubApp.controller('LostFoundController', ['$scope', 'ApiService', function($scope, ApiService) {
    $scope.items = [];
    $scope.newItem = {};
    $scope.message = '';
    $scope.showForm = false;
    $scope.isLoggedIn = false;

    $scope.checkLogin = function() {
        ApiService.checkSession().then(function(response) {
            $scope.isLoggedIn = response.data.logged_in;
        });
    };

    $scope.fetchItems = function() {
        ApiService.fetchLostItems().then(function(response) {
            if (response.data.status === 'success') {
                $scope.items = response.data.data;
            }
        }, function(error) {
            console.log('Error fetching items:', error);
        });
    };

    $scope.addItem = function() {
        if (!$scope.isLoggedIn) {
            $scope.message = 'Please login to post an item';
            $scope.showForm = false;
            return;
        }

        if (!$scope.newItem.item_name || !$scope.newItem.description || !$scope.newItem.posted_by) {
            $scope.message = 'Please fill in all fields';
            return;
        }

        ApiService.addLostItem($scope.newItem).then(function(response) {
            if (response.data.status === 'success') {
                $scope.message = 'Item posted successfully!';
                $scope.newItem = {};
                $scope.showForm = false;
                $scope.fetchItems();
            } else {
                $scope.message = response.data.message;
            }
        }, function(error) {
            $scope.message = 'An error occurred. Please try again.';
        });
    };

    $scope.deleteItem = function(itemId) {
        if (confirm('Are you sure you want to delete this item?')) {
            ApiService.deleteLostItem(itemId).then(function(response) {
                if (response.data.status === 'success') {
                    $scope.message = 'Item deleted successfully!';
                    setTimeout(function() {
                        $scope.$apply(function() {
                            $scope.fetchItems();
                        });
                    }, 300);
                } else {
                    $scope.message = response.data.message;
                }
            }, function(error) {
                $scope.message = 'Error deleting item';
                console.log('Delete error:', error);
            });
        }
    };

    $scope.checkLogin();
    $scope.fetchItems();
}]);

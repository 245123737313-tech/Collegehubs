collegeHubApp.controller('StudyMaterialsController', ['$scope', '$http', 'ApiService', function($scope, $http, ApiService) {
    $scope.materials = [];
    $scope.message = '';
    $scope.uploadForm = {
        title: '',
        description: '',
        subject: '',
        semester: 1
    };
    $scope.isUploading = false;
    $scope.isLoggedIn = false;

    // Check session to see if user is logged in
    $scope.checkLoginStatus = function() {
        ApiService.checkSession().then(function(response) {
            $scope.isLoggedIn = response.data.logged_in ? true : false;
        }, function(error) {
            $scope.isLoggedIn = false;
        });
    };

    // Fetch all materials
    $scope.fetchMaterials = function() {
        $http.get('backend/get_materials.php').then(function(response) {
            if (response.data.status === 'success') {
                $scope.materials = response.data.materials;
            } else {
                $scope.message = 'Error loading materials';
            }
        }, function(error) {
            $scope.message = 'Error loading materials';
            console.log('Error:', error);
        });
    };

    // Handle file upload
    $scope.uploadMaterial = function() {
        var fileInput = document.getElementById('fileInput');
        var file = fileInput.files[0];

        if (!file) {
            $scope.message = 'Please select a file';
            return;
        }

        if (!$scope.uploadForm.title) {
            $scope.message = 'Please enter a title';
            return;
        }

        $scope.isUploading = true;
        $scope.message = 'Uploading...';

        var formData = new FormData();
        formData.append('file', file);
        formData.append('title', $scope.uploadForm.title);
        formData.append('description', $scope.uploadForm.description);
        formData.append('subject', $scope.uploadForm.subject);
        formData.append('semester', $scope.uploadForm.semester);

        $http.post('backend/upload_material.php', formData, {
            transformRequest: angular.identity,
            headers: { 'Content-Type': undefined }
        }).then(function(response) {
            $scope.isUploading = false;
            if (response.data.status === 'success') {
                $scope.message = 'Material uploaded successfully!';
                $scope.uploadForm = {
                    title: '',
                    description: '',
                    subject: '',
                    semester: 1
                };
                fileInput.value = '';
                $scope.fetchMaterials();
            } else {
                $scope.message = response.data.message || 'Upload failed';
            }
        }, function(error) {
            $scope.isUploading = false;
            $scope.message = 'Error uploading material';
            console.log('Upload error:', error);
        });
    };

    // Download material
    $scope.downloadMaterial = function(materialId) {
        window.location.href = 'backend/download_material.php?id=' + materialId;
    };

    // Delete material
    $scope.deleteMaterial = function(materialId) {
        if (confirm('Are you sure you want to delete this material?')) {
            $http.post('backend/delete_material.php', { id: materialId }).then(function(response) {
                if (response.data.status === 'success') {
                    $scope.message = 'Material deleted successfully!';
                    $scope.fetchMaterials();
                } else {
                    $scope.message = response.data.message;
                }
            }, function(error) {
                $scope.message = 'Error deleting material';
                console.log('Delete error:', error);
            });
        }
    };

    // Get file icon based on type
    $scope.getFileIcon = function(fileType) {
        switch(fileType.toLowerCase()) {
            case 'pdf':
                return '📄';
            case 'ppt':
            case 'pptx':
                return '📊';
            case 'doc':
            case 'docx':
                return '📝';
            default:
                return '📎';
        }
    };

    // Initialize
    $scope.checkLoginStatus();
    $scope.fetchMaterials();
}]);

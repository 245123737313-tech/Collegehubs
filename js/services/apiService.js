collegeHubApp.service('ApiService', ['$http', function($http) {
    var baseUrl = 'backend/';

    return {
        register: function(data) {
            return $http.post(baseUrl + 'register.php', data, {
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                transformRequest: function(obj) {
                    var str = [];
                    for (var p in obj) {
                        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                    }
                    return str.join("&");
                }
            });
        },

        login: function(data) {
            return $http.post(baseUrl + 'login.php', data, {
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                transformRequest: function(obj) {
                    var str = [];
                    for (var p in obj) {
                        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                    }
                    return str.join("&");
                }
            });
        },

        logout: function() {
            return $http.get(baseUrl + 'logout.php');
        },

        checkSession: function() {
            return $http.get(baseUrl + 'check_session.php');
        },

        fetchNotices: function() {
            return $http.get(baseUrl + 'fetch_notices.php');
        },

        addNotice: function(data) {
            return $http.post(baseUrl + 'add_notice.php', data, {
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                transformRequest: function(obj) {
                    var str = [];
                    for (var p in obj) {
                        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                    }
                    return str.join("&");
                }
            });
        },

        fetchLostItems: function() {
            return $http.get(baseUrl + 'fetch_lostitems.php');
        },

        addLostItem: function(data) {
            return $http.post(baseUrl + 'add_lostitem.php', data, {
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                transformRequest: function(obj) {
                    var str = [];
                    for (var p in obj) {
                        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                    }
                    return str.join("&");
                }
            });
        },

        deleteNotice: function(id) {
            return $http.post(baseUrl + 'delete_notice.php', { id: id }, {
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                transformRequest: function(obj) {
                    var str = [];
                    for (var p in obj) {
                        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                    }
                    return str.join("&");
                }
            });
        },

        deleteLostItem: function(id) {
            return $http.post(baseUrl + 'delete_lostitem.php', { id: id }, {
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                transformRequest: function(obj) {
                    var str = [];
                    for (var p in obj) {
                        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                    }
                    return str.join("&");
                }
            });
        }
    };
}]);

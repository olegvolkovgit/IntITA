angular
    .module('courseRevisionsApp')
    .service('courseRevisionsActions', [
        '$http',
        function($http) {
            this.sendCourseRevision = function(id) {
                var promise = $http({
                    url: basePath+'/courseRevision/sendForApproveModule',
                    method: "POST",
                    data: $.param({idRevision: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    if(response.data!='') {
                        if(typeof redirectFromEdit!='undefined'){
                            return response.data;
                        }else{
                            bootbox.alert(response.data);
                            return false;
                        }
                    }
                }, function errorCallback() {
                    bootbox.alert("Відправити ревізію модуля на затвердження не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            this.cancelSendCourseRevision = function(id) {
                var promise = $http({
                    url: basePath+'/courseRevision/cancelSendForApproveModule',
                    method: "POST",
                    data: $.param({idRevision: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Відмінити відправлення ревізії модуля на затвердження не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            this.approveCourseRevision = function(id) {
                var promise = $http({
                    url: basePath+'/courseRevision/approveModuleRevision',
                    method: "POST",
                    data: $.param({idRevision: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Затвердити ревізію модуля не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            this.rejectCourseRevision = function(id,comment) {
                var promise = $http({
                    url: basePath+'courseRevision/rejectModuleRevision',
                    method: "POST",
                    data: $.param({idRevision: id, comment: comment}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Відхилити відправку на затвердження не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            this.cancelCourseRevision = function(id) {
                var promise = $http({
                    url: basePath+'courseRevision/cancelModuleRevision',
                    method: "POST",
                    data: $.param({idRevision: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Скасувати ревізію модуля не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            this.cancelCourseEditByEditor = function(id) {
                var promise = $http({
                    url: basePath+'/courseRevision/cancelEditModuleRevisionByEditor',
                    method: "POST",
                    data: $.param({idRevision: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Відмінити ревізію модуля не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            this.restoreCourseEditByEditor = function(id) {
                var promise = $http({
                    url: basePath+'/courseRevision/restoreEditModuleRevisionByEditor',
                    method: "POST",
                    data: $.param({idRevision: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Відновити ревізію автором не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            this.releaseCourseRevision = function(id) {
                var promise = $http({
                    url: basePath+'/courseRevision/readyModuleRevision',
                    method: "POST",
                    data: $.param({idRevision: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Відправити на реліз ревізію не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
        }
    ]);
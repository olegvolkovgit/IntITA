angular
    .module('moduleRevisionsApp')
    .service('moduleRevisionsActions', [
        '$http',
        function($http) {
            this.sendModuleRevision = function(id) {
                var promise = $http({
                    url: basePath+'/moduleRevision/sendForApproveModule',
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
            this.cancelSendModuleRevision = function(id) {
                var promise = $http({
                    url: basePath+'/moduleRevision/cancelSendForApproveModule',
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
            this.approveModuleRevision = function(id) {
                var promise = $http({
                    url: basePath+'/moduleRevision/approveModuleRevision',
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
            this.rejectModuleRevision = function(id) {
                var promise = $http({
                    url: basePath+'/moduleRevision/rejectModuleRevision',
                    method: "POST",
                    data: $.param({idRevision: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Відхилити відправку на затвердження не вдалося. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            this.cancelModuleRevision = function(id) {
                var promise = $http({
                    url: basePath+'/moduleRevision/cancelModuleRevision',
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
            this.cancelModuleEditByEditor = function(id) {
                var promise = $http({
                    url: basePath+'/moduleRevision/cancelEditModuleRevisionByEditor',
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
            this.restoreModuleEditByEditor = function(id) {
                var promise = $http({
                    url: basePath+'/moduleRevision/restoreEditModuleRevisionByEditor',
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
            this.releaseModuleRevision = function(id) {
                var promise = $http({
                    url: basePath+'/moduleRevision/readyModuleRevision',
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
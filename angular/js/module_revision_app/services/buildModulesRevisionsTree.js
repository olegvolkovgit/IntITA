angular
    .module('moduleRevisionsApp')
    .service('modulesRevisionsTree', [
        '$http',
        function($http) {
            this.getCurrentModules = function (idCourse) {
                var promise = $http({
                    url: basePath + '/moduleRevision/buildCurrentModuleJson',
                    method: "POST",
                    data: $.param({idCourse: idCourse}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені списку актуальних модулів курса. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            this.getModuleRevisionsInCourse  = function(idCourse) {
                var url=basePath+'/moduleRevision/buildRevisionsInCourse';
                var promise = $http({
                    url: url,
                    method: "POST",
                    data: $.param({idCourse: idCourse}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені списку ревізій модулів курса. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };

            this.getModuleRevisions  = function(idModule) {
                var url=basePath+'/moduleRevision/buildModuleRevisions';
                var promise = $http({
                    url: url,
                    method: "POST",
                    data: $.param({idModule: idModule}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені ревізій модуля. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };

            this.getModuleData  = function(idModule) {
                var url=basePath+'/moduleRevision/getModuleData';
                var promise = $http({
                    url: url,
                    method: "POST",
                    data: $.param({idModule: idModule}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені даних модуля. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            
            this.getAllModulesRevisionsJson = function() {
                var promise = $http({
                    url: basePath+'/moduleRevision/buildAllModulesRevisions',
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені списку ревізій модулів. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };

            this.revisionTreeFilterInModule  = function(idModule,status) {
                var promise = $http({
                    url: basePath+'/moduleRevision/buildTreeInModule',
                    method: "POST",
                    data: $.param({idModule: idModule,status:status.revisionFilter}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені списку ревізій модуля. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };

            this.revisionTreeFilterInCourse  = function(idCourse,status) {
                var promise = $http({
                    url: basePath+'/moduleRevision/buildTreeInCourse',
                    method: "POST",
                    data: $.param({idCourse: idCourse,status:status.revisionFilter}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені списку ревізій курса. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };

            this.allModulesRevisionsTreeFilter  = function(status) {
                var promise = $http({
                    url: basePath+'/moduleRevision/buildAllModulesTree',
                    method: "POST",
                    data: $.param({status:status.revisionFilter}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені списку ревізій модулів. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
        }
    ]);
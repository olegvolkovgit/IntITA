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
                    bootbox.alert("Виникла помилка при завантажені списку ревізій курса. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            //
            // this.getRevisionsBranch  = function(idRevision,approved) {
            //     var url;
            //     if(approved=='true') {
            //         url=basePath+'/revision/buildApprovedLectureRevisions';
            //     } else url=basePath+'/revision/buildRevisionsBranch';
            //     var promise = $http({
            //         url: url,
            //         method: "POST",
            //         data: $.param({idRevision: idRevision}),
            //         headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            //     }).then(function successCallback(response) {
            //         return response.data;
            //     }, function errorCallback() {
            //         bootbox.alert("Виникла помилка при завантажені списку ревізій заняття. Зв'яжіться з адміністрацією");
            //         return false;
            //     });
            //     return promise;
            // };
            //
            // this.getAllRevisionsJson = function() {
            //     var promise = $http({
            //         url: basePath+'/revision/buildAllRevisions',
            //         method: "POST",
            //         headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            //     }).then(function successCallback(response) {
            //         return response.data;
            //     }, function errorCallback() {
            //         bootbox.alert("Виникла помилка при завантажені списку ревізій. Зв'яжіться з адміністрацією");
            //         return false;
            //     });
            //     return promise;
            // };
            //
            // this.getTestRevisionsBranch  = function(idRevision) {
            //     var status='Відправлена на розгляд';
            //     var promise = $http({
            //         url: basePath+'/revision/buildTree',
            //         method: "POST",
            //         data: $.param({idRevision: idRevision,status:status}),
            //         headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            //     }).then(function successCallback(response) {
            //         return response.data;
            //     }, function errorCallback() {
            //         bootbox.alert("Виникла помилка при завантажені списку ревізій заняття. Зв'яжіться з адміністрацією");
            //         return false;
            //     });
            //     return promise;
            // };
            //
            // this.revisionTreeFilterInBranch  = function(idRevision,status) {
            //     var promise = $http({
            //         url: basePath+'/revision/buildTreeInBranch',
            //         method: "POST",
            //         data: $.param({idRevision: idRevision,status:status.revisionFilter}),
            //         headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            //     }).then(function successCallback(response) {
            //         return response.data;
            //     }, function errorCallback() {
            //         bootbox.alert("Виникла помилка при завантажені списку ревізій заняття. Зв'яжіться з адміністрацією");
            //         return false;
            //     });
            //     return promise;
            // };
            //
            // this.revisionTreeFilterInModule  = function(idModule,status) {
            //     var promise = $http({
            //         url: basePath+'/revision/buildTreeInModule',
            //         method: "POST",
            //         data: $.param({idModule: idModule,status:status.revisionFilter}),
            //         headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            //     }).then(function successCallback(response) {
            //         return response.data;
            //     }, function errorCallback() {
            //         bootbox.alert("Виникла помилка при завантажені списку ревізій модуля. Зв'яжіться з адміністрацією");
            //         return false;
            //     });
            //     return promise;
            // };
        }
    ]);
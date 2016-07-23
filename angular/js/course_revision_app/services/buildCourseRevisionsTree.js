angular
    .module('courseRevisionsApp')
    .service('courseRevisionsTree', [
        '$http',
        function($http) {
            this.getCurrentModules = function (idCourse) {
                var promise = $http({
                    url: basePath + '/courseRevision/buildCurrentModuleJson',
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
            this.getCourseRevisions  = function(idCourse) {
                var url=basePath+'/courseRevision/buildCourseRevisions';
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

            this.getModuleRevisions  = function(idModule) {
                var url=basePath+'/courseRevision/buildModuleRevisions';
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
                var url=basePath+'/courseRevision/getModuleData';
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
                    url: basePath+'/courseRevision/buildAllModulesRevisions',
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

            this.revisionTreeFilterInModule  = function(idModule,status, idAuthor) {
                var promise = $http({
                    url: basePath+'/courseRevision/buildTreeInModule',
                    method: "POST",
                    data: $.param({idModule: idModule,status:status.revisionFilter, idAuthor:idAuthor}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені списку ревізій модуля. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };

            this.courseRevisionTreeFilter  = function(idCourse,status, idAuthor) {
                var promise = $http({
                    url: basePath+'/courseRevision/buildCourseRevisionTree',
                    method: "POST",
                    data: $.param({idCourse: idCourse,status:status.revisionFilter, idAuthor:idAuthor}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені списку ревізій курса. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };

            this.allModulesRevisionsTreeFilter  = function(status, idAuthor) {
                var promise = $http({
                    url: basePath+'/courseRevision/buildAllModulesTree',
                    method: "POST",
                    data: $.param({status:status.revisionFilter, idAuthor:idAuthor}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені списку ревізій модулів. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };

            this.getCourseRevisionsAuthors  = function(idCourse) {
                var params;
                if(idCourse){
                    params={idCourse:idCourse};
                }else{
                    params={};
                }
                var promise = $http({
                    url: basePath+'/courseRevision/courseRevisionsAuthors',
                    method: "POST",
                    data: $.param(params),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені списку авторів ревізій курса. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
        }
    ]);
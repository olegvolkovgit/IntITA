angular
    .module('courseRevisionsApp')
    .service('courseRevisionsTree', [
        '$http',
        function($http) {
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
                    bootbox.alert("Виникла помилка при завантажені списку ревізій курсу. Зв'яжіться з адміністрацією");
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

            this.getCourseData  = function(idCourse) {
                var url=basePath+'/courseRevision/getCourseData';
                var promise = $http({
                    url: url,
                    method: "POST",
                    data: $.param({idCourse: idCourse}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені даних курсу. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            
            this.getAllCoursesRevisionsJson = function() {
                var promise = $http({
                    url: basePath+'/courseRevision/buildAllCoursesRevisions',
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
                    bootbox.alert("Виникла помилка при завантажені списку ревізій курсу. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };

            this.allCoursesRevisionsTreeFilter  = function(status, idAuthor) {
                var promise = $http({
                    url: basePath+'/courseRevision/buildAllCoursesTree',
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
                    bootbox.alert("Виникла помилка при завантажені списку авторів ревізій курсу. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
        }
    ]);
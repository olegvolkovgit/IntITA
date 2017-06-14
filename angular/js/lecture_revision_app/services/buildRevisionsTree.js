angular
    .module('revisionTreesApp')
    .service('revisionsTree', [
        '$http',
        function($http) {
            this.getCurrentLectures = function (idModule) {
                var promise = $http({
                    url: basePath + '/revision/buildCurrentLectureJson',
                    method: "POST",
                    data: $.param({idModule: idModule}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені списку актуальних занять модуля. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
            this.getLectureRevisionsInModuleJson  = function(idModule) {
                var promise = $http({
                    url: basePath+'/revision/buildRevisionsInModule',
                    method: "POST",
                    data: $.param({idModule: idModule}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені списку ревізій модуля. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };

            this.getRevisionsBranch  = function(idRevision) {
                var promise = $http({
                    url: basePath+'/revision/buildRevisionsBranch',
                    method: "POST",
                    data: $.param({idRevision: idRevision}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені списку ревізій заняття. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };

            this.getAllRevisionsJson = function(data) {
                var promise = $http({
                    url: basePath+'/revision/buildAllRevisions',
                    method: "POST",
                    data: $.param({organization: data.organization}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені списку ревізій. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };

            this.revisionTreeFilterInBranch  = function(idRevision,status, idAuthor) {
                var promise = $http({
                    url: basePath+'/revision/buildTreeInBranch',
                    method: "POST",
                    data: $.param({idRevision: idRevision,status:status.revisionFilter, idAuthor:idAuthor}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені списку ревізій заняття. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };

            this.revisionTreeFilterInModule  = function(idModule,status, idAuthor) {
                var promise = $http({
                    url: basePath+'/revision/buildTreeInModule',
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

            this.allRevisionsTreeFilter  = function(status, idAuthor) {
                var promise = $http({
                    url: basePath+'/revision/buildAllFilteredRevisionsTree',
                    method: "POST",
                    data: $.param({status:status.revisionFilter, idAuthor:idAuthor}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені списку ревізій. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };

            this.getRevisionsAuthors  = function(idModule,idRevision) {
                var params;
                if(idModule){
                    params={idModule:idModule};
                }else if(idRevision){
                    params={idRevision:idRevision};
                }else{
                    params={};
                }
                var promise = $http({
                    url: basePath+'/revision/revisionsAuthors',
                    method: "POST",
                    data: $.param(params),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка при завантажені списку авторів. Зв'яжіться з адміністрацією");
                    return false;
                });
                return promise;
            };
        }
    ]);
'use strict';

/* Services */

angular
    .module('mainApp')
    .service('documentsServices', [
        '$http',
        function($http) {
            this.getDocumentsTypes = function () {
                var promise = $http({
                    url: basePath + "/studentreg/getDocumentsTypes",
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    console.log("Виникла помилка при завантажені типів документів");
                });
                return promise;
            };
        }
    ]);
'use strict';

angular
    .module('mainApp')
    .service('careerService', [
        '$http',
        function($http) {
            this.getCareersList = function () {
                var promise = $http({
                    url: basePath + "/studentreg/getcareerslist",
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    console.log("Виникла помилка при завантажені варіантів кар'єр. Зв'яжіться з адміністратором сайту.");
                });
                return promise;
            };
        }
    ]);
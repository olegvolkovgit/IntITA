/**
 * Created by Wizlight on 15.07.2016.
 */
angular
    .module('mainApp')
    .service('specializations', [
        '$http',
        function($http) {
            this.getSpecializationsList = function () {
                var promise = $http({
                    url: basePath + "/studentreg/getspecializationslist",
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    console.log("Виникла помилка при завантажені доступних спеціалізацій. Зв'яжіться з адміністратором сайту.");
                });
                return promise;
            };
        }
    ]);
/**
 * Created by Wizlight on 21.01.2016.
 */
angular
    .module('interpreterApp')
    .service('getTaskJson', [
        '$http',
        function($http) {
            this.getJson = function () {
                $http({
                    url: 'http://ii.intita.com',
                    method: "POST",
                    data: JSON.stringify(json),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    console.log(response.data);
                }, function errorCallback() {
                    alert("Вибачте, але на сайті виникла помилка і додати задачу до заняття наразі неможливо. Спробуйте додати пізніше або зв'яжіться з адміністратором сайту.");
                });
            };
        }
    ]);
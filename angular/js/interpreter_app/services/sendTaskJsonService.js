/**
 * Created by Wizlight on 23.12.2015.
 */
angular
    .module('interpreterApp')
    .service('sendTaskJsonService', [
        '$http',
        function($http) {
            this.sendJson = function (url,jsonTask) {
                $http({
                    url: url,
                    method: "POST",
                    data: $.param(JSON.stringify(jsonTask)),
                    headers: {'Content-Type': 'application/json; charset=utf-8'}
                }).then(function successCallback(response) {
                    console.log(response.data);
                }, function errorCallback() {
                    alert("Вибачте, але на сайті виникла помилка і додати задачу до заняття наразі неможливо. Спробуйте додати пізніше або зв'яжіться з адміністратором сайту.");
                });
            };
        }
    ]);
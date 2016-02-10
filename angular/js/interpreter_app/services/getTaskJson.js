/**
 * Created by Wizlight on 21.01.2016.
 */
angular
    .module('interpreterApp')
    .service('getTaskJson', [
        '$http',
        function($http) {
            this.getJson = function (lng,id,url) {
                var json={
                    "operation": "getJson",
                    "lang": lng,
                    "task": id
                };
                var promise = $http({
                    url: url,
                    method: "POST",
                    data: JSON.stringify(json),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    if(response.data.status=='success'){
                        return response.data.json;
                    }
                }, function errorCallback() {
                    alert("Вибачте, але на сайті виникла помилка і додати задачу до заняття наразі неможливо. Спробуйте додати пізніше або зв'яжіться з адміністратором сайту.");
                });
                return promise;
            };
        }
    ]);
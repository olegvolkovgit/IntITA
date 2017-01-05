/**
 * Created by Wizlight on 21.01.2016.
 */
angular
    .module('interpreterApp')
    .service('getTaskJson', [
        '$http',
        function($http) {
            this.getJson = function (id,url) {
                var json={
                    "operation": "getJson",
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
                }, function errorCallback(response) {
                    console.log(response);
                    alert("Вибачте, але на сайті виникла помилка. Спробуйте пізніше або зв'яжіться з адміністрацією сайту.");
                });
                return promise;
            };
        }
    ]);
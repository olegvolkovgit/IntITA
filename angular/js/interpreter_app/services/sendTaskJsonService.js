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
                    data: JSON.stringify(jsonTask),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    if(response.data.status=='updated') {
                        bootbox.alert("Зміни юніттестів успішно скомпільовані");
                    } else if(response.data.status=='success') {
                        bootbox.alert("Додані юніттести успішно скомпільовані");
                    } else if(response.data.status=='failed') {
                        console.log('Змін не відбулося');
                    } else {
                        bootbox.alert("Виникла помилка при компіляції:"+"<br/>"+response.data.status);
                    }
                }, function errorCallback(response) {
                    console.log(response);
                    bootbox.alert("Вибач, але на сайті виникла помилка. Спробуй пізніше або зв'яжись з адміністратором сайту.");
                });
            };
        }
    ]);
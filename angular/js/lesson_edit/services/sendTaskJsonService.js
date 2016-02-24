/**
 * Created by Wizlight on 23.12.2015.
 */
angular
    .module('lessonEdit')
    .service('sendTaskJsonService', [
        '$http',
        function($http) {
            this.sendJson = function (url,jsonTask) {
                console.log(jsonTask);
                var promise =$http({
                    url: url,
                    method: "POST",
                    data: JSON.stringify(jsonTask),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    if(response.data.status=='updated') {
                        bootbox.alert("Мову юніттеста успішно змінено");
                        return true;
                    } else if(response.data.status=='success') {
                        bootbox.alert("Юніттест успішно додано");
                        return true;
                    } else if(response.data.status=='failed') {
                        return true;
                    } else {
                        bootbox.alert("Виникла помилка при компіляції:"+"<br/>"+response.data.status+"<br/>"+"Спочатку виправ помилку, а потім змінюй мову");
                        return false;
                    }
                }, function errorCallback() {
                    bootbox.alert("Вибач, але на сайті виникла помилка і змінити мову мову юніттеста не вдалося. Спробуй пізніше або зв'яжись з адміністратором сайту.");
                    return false;
                });
                return promise;
            };
        }
    ]);
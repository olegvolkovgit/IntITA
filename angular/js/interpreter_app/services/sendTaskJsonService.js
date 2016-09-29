/**
 * Created by Wizlight on 23.12.2015.
 */
angular
    .module('interpreterApp')
    .service('sendTaskJsonService', [
        '$http',
        function($http) {
            var self = this;
            self.sendJson = function (url,jsonTask,idTask) {
                $('#ajaxLoad').center().show();
                $http({
                    url: basePath+'/interpreter/editTask',
                    method: "POST",
                    data: $.param({
                        json: JSON.stringify(jsonTask),
                        idTask: idTask,
                    }),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    if(response.data) {
                        $('#ajaxLoad').hide();
                        bootbox.alert(response.data, function () {
                            location.reload();
                        });
                    } else{
                        self.send(url,jsonTask);
                    }
                }, function errorCallback(response) {
                    $('#ajaxLoad').hide();
                    console.log(response);
                    bootbox.alert("Вибач, але виникла помилка при отримані інформації про стан задачі даної ревізії. Спробуй пізніше або зв'яжись з адміністратором сайту.");
                });
            };

            self.send = function (url,jsonTask) {
                $http({
                    url: url,
                    method: "POST",
                    data: JSON.stringify(jsonTask),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    $('#ajaxLoad').hide();
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
                    $('#ajaxLoad').hide();
                    console.log(response);
                    bootbox.alert("Вибач, але на сайті виникла помилка. Спробуй пізніше або зв'яжись з адміністратором сайту.");
                });
            };
        }
    ]);

jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", ($(window).scrollTop() + 50 + "px"));
    this.css("left", (($(window).width() - this.outerWidth()) / 2) + $(window).scrollLeft() + "px");
    return this;
}
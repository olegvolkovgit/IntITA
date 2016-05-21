/**
 * Created by Wizlight on 22.04.2016.
 */
angular
    .module('lectureRevision')
    .service('getLectureData', [
        '$http',
        function($http) {
            this.getData = function (id) {
                var promise = $http({
                    url: basePath+'/revision/getRevisionPreviewData',
                    method: "POST",
                    data: $.param({idRevision: id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    bootbox.alert("Помилка сервера. Спробуйте ще раз або зв'яжіться з адміністратором сайту.");
                    return false;
                });
                return promise;
            };
        }
    ]);
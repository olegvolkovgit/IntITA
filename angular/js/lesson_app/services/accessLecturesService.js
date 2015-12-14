/**
 * Created by Wizlight on 10.12.2015.
 */
angular
    .module('lessonApp')
    .service('accessLectureService', [
        '$rootScope','$http',
        function($rootScope, $http) {

            this.getAccessLectures = function() {
                $http({
                    url: basePath + '/lesson/GetAccessLectures',
                    method: "POST",
                    data: $.param({module: idModule}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response){
                    //console.log(response.data);
                    $rootScope.lectures=response.data;
                }, function errorCallback(response) {
                    alert('Error getAccessLectures');
                });
            };
        }
    ]);
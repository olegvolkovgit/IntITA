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
                    data: $.param({module: idModule, course:idCourse,lecture:idLecture}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response){
                    $rootScope.lecturesData=response.data;
                }, function errorCallback() {
                    console.log('Error getAccessLectures');
                });
            };
        }
    ]);
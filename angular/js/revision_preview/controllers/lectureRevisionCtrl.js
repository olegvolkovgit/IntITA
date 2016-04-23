/**
 * Created by Wizlight on 03.11.2015.
 */
angular
    .module('revisionPreviewApp')
    .controller('lectureRevisionCtrl',lectureRevisionCtrl);

function lectureRevisionCtrl($rootScope,$scope, $http, getLectureData) {
    getLectureData.getData(idRevision).then(function(response){
        $rootScope.lectureData=response;
    });

    $scope.editRevision = function(url) {
        location.href = url;
    };
    $scope.sendRevision = function(id) {
        $http({
            url: basePath+'/revision/sendForApproveLecture',
            method: "POST",
            data: $.param({idRevision: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback() {
            getLectureData.getData(idRevision).then(function(response){
                $rootScope.lectureData=response;
            });
        }, function errorCallback() {
            bootbox.alert("Відправити заняття на затвердження не вдалося. Зв'яжіться з адміністрацією");
            return false;
        });
    };
    $scope.cancelSendRevision = function(id) {
        $http({
            url: basePath+'/revision/cancelSendForApproveLecture',
            method: "POST",
            data: $.param({idRevision: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback() {
            getLectureData.getData(idRevision).then(function(response){
                $rootScope.lectureData=response;
            });
        }, function errorCallback() {
            bootbox.alert("Відмінити відправку заняття на затвердження не вдалося. Зв'яжіться з адміністрацією");
            return false;
        });
    };
    $scope.approveRevision = function(id) {
        $http({
            url: basePath+'/revision/approveLectureRevision',
            method: "POST",
            data: $.param({idRevision: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback() {
            getLectureData.getData(idRevision).then(function(response){
                $rootScope.lectureData=response;
            });
        }, function errorCallback() {
            bootbox.alert("Затвердити заняття не вдалося. Зв'яжіться з адміністрацією");
            return false;
        });
    };
    $scope.cancelRevision = function(id) {
        $http({
            url: basePath+'/revision/cancelLectureRevision',
            method: "POST",
            data: $.param({idRevision: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback() {
            getLectureData.getData(idRevision).then(function(response){
                $rootScope.lectureData=response;
            });
        }, function errorCallback() {
            bootbox.alert("Скасувати заняття не вдалося. Зв'яжіться з адміністрацією");
            return false;
        });
    };
    $scope.rejectRevision = function(id) {
        $http({
            url: basePath+'/revision/rejectLectureRevision',
            method: "POST",
            data: $.param({idRevision: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback() {
            getLectureData.getData(idRevision).then(function(response){
                $rootScope.lectureData=response;
            });
        }, function errorCallback() {
            bootbox.alert("Відхилити ревізію не вдалося. Зв'яжіться з адміністрацією");
            return false;
        });
    };
}

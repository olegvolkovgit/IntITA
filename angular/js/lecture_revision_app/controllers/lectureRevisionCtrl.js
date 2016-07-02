/**
 * Created by Wizlight on 03.11.2015.
 */
angular
    .module('lectureRevisionApp')
    .filter('quizType', function() {
        return function(input) {
            var type;
            switch (input) {
                case '5':
                    type='Задача';
                    break;
                case '6':
                    type='Проста задача';
                    break;
                case '9':
                    type='Задача з пропусками';
                    break;
                case '12':
                    type='Тест';
                    break;
                default:
                    type='';
            }
            return type;
        };
    })
    .filter('videoCheck', function() {
        return function(input) {
            return input ? '\u2713' : '';
        };
    })
    .controller('lectureRevisionCtrl',lectureRevisionCtrl);

function lectureRevisionCtrl($rootScope,$scope, $http, getLectureData, revisionsActions) {
    //load from service lecture data for scope
    getLectureData.getData(idRevision).then(function(response){
        $rootScope.lectureData=response;
    });

    $scope.editPageRevision = function(pageId) {
        location.href=basePath+'/revision/editPageRevision?idPage='+pageId;
    };

    $scope.previewRevision = function(url) {
        location.href=url;
    };
    //send revision for approve
    $scope.sendRevision = function(id) {
        revisionsActions.sendRevision(id).then(function(){
            getLectureData.getData(idRevision).then(function(response){
                $rootScope.lectureData=response;
                location.href=basePath+'/revision/previewLectureRevision?idRevision='+idRevision;
            });
        });
    };
    //canceled edit revision by the editor
    $scope.cancelEditByEditor = function(id) {
        revisionsActions.cancelEditByEditor(id).then(function(){
            getLectureData.getData(idRevision).then(function(response){
                $rootScope.lectureData=response;
                location.href=basePath+'/revision/previewLectureRevision?idRevision='+idRevision;
            });
        });
    };
    //add new page for lecture revision
    $scope.addPage = function() {
        $http({
            url: basePath+'/revision/addPage',
            method: "POST",
            data: $.param({idRevision:idRevision}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback() {
            getLectureData.getData(idRevision).then(function(response){
                $rootScope.lectureData=response;
                $('body,html').animate({scrollTop: $(document).height()}, 500);
            });
        }, function errorCallback(response) {
            if(response.status==403){
                bootbox.alert('У вас недостатньо прав для редагування сторінки.');
            }
            return false;
        });
    };
    //reorder pages
    $scope.up = function(pageId) {
        $http({
            url: basePath+'/revision/upPage',
            method: "POST",
            data: $.param({idPage:pageId, idRevision: idRevision}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback() {
            getLectureData.getData(idRevision).then(function(response){
                $rootScope.lectureData=response;
            });
        }, function errorCallback() {
            return false;
        });
    };
    $scope.down = function(pageId) {
        $http({
            url: basePath+'/revision/downPage',
            method: "POST",
            data: $.param({idPage:pageId, idRevision: idRevision}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback() {
            getLectureData.getData(idRevision).then(function(response){
                $rootScope.lectureData=response;
            });
        }, function errorCallback() {
            return false;
        });
    };
    $scope.delete = function(pageId) {
        bootbox.confirm('Видалити частину заняття?', function(result){
            if(result){
                $http({
                    url: basePath+'/revision/deletePage',
                    method: "POST",
                    data: $.param({idPage:pageId,idRevision:idRevision}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback() {
                    getLectureData.getData(idRevision).then(function(response){
                        $rootScope.lectureData=response;
                    });
                }, function errorCallback() {
                    return false;
                });
            };
        })
    };
    //check whether you can send the lecture for approval
    $scope.checkLecture = function() {
        $http({
            url: basePath+'/revision/checkLecture',
            method: "POST",
            data: $.param({idRevision:idRevision}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data);
        }, function errorCallback(response) {
            console.log('checkLecture error');
            console.log(response);
            return false;
        });
    };
}

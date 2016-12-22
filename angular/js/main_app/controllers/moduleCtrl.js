/**
 * Created by Wizlight on 15.02.2016.
 */
angular
    .module('mainApp')
    .controller('moduleCtrl',moduleCtrl);

function moduleCtrl($scope, $http) {
    $scope.finishedPrevLectureMsg=finishedPrevLectureMsg;
    
    $scope.payService=function (scenario,id, isGuest) {
        if(isGuest){
            $("#authDialog").dialog("open");
            if ($("#hambMenu").is(':visible'))
                $("#hambMenu").css({display: "none"});
            return false;
        }else{
            $scope.educationForm='online';
            $scope.schemeId=0;
            location.href = basePath + '/cabinet#/'+scenario+'/'+id+'/'+$scope.educationForm+'/scheme/'+$scope.schemeId;   
        }
    };

    $scope.loadLecturesList=function () {
        var promise = $http({
            url: basePath+'/module/moduleData',
            method: "POST",
            data: $.param({moduleId: idModule, courseId: idCourse}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return response.data;
        }, function errorCallback() {
            return false;
        });
        return promise;
    };
    
    $scope.loadLecturesList().then(function (response) {
        $scope.basePath=basePath;
        $scope.module=response;
        var title='title_'+lang;

        if($scope.module.user)
            $scope.module.user.lastAccessLectureOrder=Number($scope.module.user.lastAccessLectureOrder);
        $scope.module.lectures.forEach(function(item, key) {
            $scope.module.lectures[key].order=Number($scope.module.lectures[key].order);
            $scope.module.lectures[key].title=$scope.module.lectures[key][title]!=''?$scope.module.lectures[key][title]:$scope.module.lectures[key]['ua'];

            if($scope.module.user && ($scope.module.moduleAccess || !$scope.module.notAccessMessage || ($scope.module.lectures[key].isFree && $scope.module.lectures[key].order<=$scope.module.user.lastAccessLectureOrder)))
                $scope.module.lectures[key].ico='enabled.png';
            else $scope.module.lectures[key].ico='disabled.png';

        });
    });

    //redirect to lecture page
    $scope.lectureLink = function (idLecture, idCourse) {
        $http
            .get(basePath + '/lesson/getLectureLink', {
                params: {
                    idLecture: idLecture,
                    idCourse: idCourse
                }
            })
            .then(function successCallback(response) {
                location.href = response.data;
            }, function errorCallback() {
                return false;
            });
    };
    
    $scope.sendRequest=function(url){
        bootbox.confirm("Відправити запит на редагування цього модуля?", function(result) {
            if (result) {
                $http({
                    url: url,
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    bootbox.alert(response.data, function(){
                        location.reload();
                    });
                }, function errorCallback() {
                    bootbox.alert("Запит не вдалося надіслати.");
                });
            } else {
                bootbox.alert("Запит відмінено.");
            }
        });
    }
}

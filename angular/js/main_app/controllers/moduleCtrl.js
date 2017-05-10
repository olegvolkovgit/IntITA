/**
 * Created by Wizlight on 15.02.2016.
 */
angular
    .module('mainApp')
    .controller('moduleCtrl',moduleCtrl)

function moduleCtrl($scope, $http) {
    $scope.finishedPrevLectureMsg=finishedPrevLectureMsg;

    $scope.getPaymentServiceStatus=function (id, service) {
        var promise = $http({
            url: basePath+'/course/getPaymentServiceStatus',
            method: "POST",
            data: $.param({id: id, service: service}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return response.data;
        }, function errorCallback() {
            return false;
        });
        return promise;
    };
    $scope.getPaymentServiceStatus(idModule, 'module').then(function (response) {
        $scope.moduleStatus=response;
    });
    if(idCourse!=0){
        $scope.getPaymentServiceStatus(idCourse, 'course').then(function (response) {
            $scope.courseStatus=response;
        });
    }

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
    $scope.redirectToCabinet=function (scenario,id,selectedScheme) {
        location.href = basePath + '/cabinet#/'+scenario+'/'+id+'/'+selectedScheme.educForm+'/scheme/'+selectedScheme.schemeId;
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
        $scope.moduleProgress=response;
        if($scope.moduleProgress.course){
            $scope.moduleProgress.course.status=parseInt($scope.moduleProgress.course.status_online) || parseInt($scope.moduleProgress.course.status_offline);
            $scope.moduleProgress.course.canPayCourse=$scope.moduleProgress.course.status && !parseInt($scope.moduleProgress.course.cancelled);
        }
        $scope.moduleProgress.canPayModule=parseInt($scope.moduleProgress.module.status_online) || parseInt($scope.moduleProgress.module.status_offline) && !parseInt($scope.moduleProgress.module.cancelled);

        var title='title_'+lang;
        if($scope.moduleProgress.user)
            $scope.moduleProgress.user.lastAccessLectureOrder=Number($scope.moduleProgress.user.lastAccessLectureOrder);
        $scope.moduleProgress.module.lectures.forEach(function(item, key) {
            $scope.moduleProgress.module.lectures[key].order=Number($scope.moduleProgress.module.lectures[key].order);
            $scope.moduleProgress.module.lectures[key].title=$scope.moduleProgress.module.lectures[key][title]!=''?$scope.moduleProgress.module.lectures[key][title]:$scope.moduleProgress.module.lectures[key]['ua'];

            if($scope.moduleProgress.moduleAccess===true ||
                (!$scope.moduleProgress.notAccessMessage && $scope.moduleProgress.module.lectures[key].order<=$scope.moduleProgress.user.lastAccessLectureOrder) ||
                ($scope.moduleProgress.moduleAccess!==false && parseInt($scope.moduleProgress.module.lectures[key].isFree) && $scope.moduleProgress.module.lectures[key].order<=$scope.moduleProgress.user.lastAccessLectureOrder))
                $scope.moduleProgress.module.lectures[key].ico='enabled.png';
            else $scope.moduleProgress.module.lectures[key].ico='disabled.png';

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
}
/**
 * Created by Wizlight on 15.02.2016.
 */
angular
    .module('mainApp')
    .controller('moduleListCtrl',moduleListCtrl)

function moduleListCtrl($http,$scope) {

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

    var date = new Date();
    var currentTime=Math.round(date.getTime()/1000);
    $scope.getModuleProgressForUser=function (idCourse) {
        $('.modulesLoading').show();
        var promise = $http({
            url: basePath+'/course/courseProgress',
            method: "POST",
            data: $.param({id: idCourse}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return response.data;
        }, function errorCallback() {
            return false;
        });
        return promise;
    };
    $scope.getModuleProgressForUser(idCourse).then(function (response) {
        $scope.titleParam='title_'+lg;
        $scope.basePath=basePath;
        $scope.courseProgress=response;
        $scope.courseProgress.courseStatus=parseInt($scope.courseProgress.course.status_online) || parseInt($scope.courseProgress.course.status_offline);

        if(!$scope.courseProgress.user){
            $scope.courseProgress.ico='disabled.png';
        }else if(!$scope.courseProgress.courseStatus)
            $scope.courseProgress.ico='development.png';

        for(var i=0;i<$scope.courseProgress.modules.length;i++){
            if(!$scope.courseProgress.modules[i].access){
                $scope.courseProgress.modules[i].progress='disabled';
            }else{
                if($scope.courseProgress.modules[i].startTime && $scope.courseProgress.modules[i].finishTime){
                    $scope.courseProgress.modules[i].progress='finished';
                    $scope.courseProgress.modules[i].spentTime=Math.round(($scope.courseProgress.modules[i].finishTime-$scope.courseProgress.modules[i].startTime)/86400)+1;
                }else if($scope.courseProgress.modules[i].startTime && !$scope.courseProgress.modules[i].finishTime){
                    $scope.courseProgress.modules[i].progress='inProgress';
                    $scope.courseProgress.modules[i].spentTime=Math.round((currentTime-$scope.courseProgress.modules[i].startTime)/86400)+1;
                }else if(!($scope.courseProgress.modules[i].startTime || $scope.courseProgress.modules[i].finishTime) ||
                    !$scope.courseProgress.modules[i].startTime && $scope.courseProgress.modules[i].finishTime){
                    $scope.courseProgress.modules[i].progress='queue';
                }
            }
        }

        if($scope.courseProgress.course.course_done){
            // var fullTime=0;
            // var recommendedTime=0;
            // for(var j = 0; j < $scope.courseProgress.modules.length; j++){
            //     fullTime=fullTime+$scope.courseProgress.modules[j].spentTime;
            //     recommendedTime=recommendedTime+$scope.courseProgress.modules[j].duration;
            // }
            $scope.courseProgress.fullTime=Math.round(($scope.courseProgress.course.date_done-$scope.courseProgress.course.start_course)/86400)+1;
            // $scope.courseProgress.recommendedTime=recommendedTime;
        }

        $('.modulesLoading').hide();
    });

    $scope.getPaymentServiceStatus(idCourse, 'course').then(function (response) {
        $scope.status=response;
    });

    $scope.daysTermination=function(day){
        day=day.toString();
        var number = day.substr(-2);
        var term;
        if (number > 10 && number < 15) {
            term = $scope.courseProgress.translations[0];
        } else {
            number = number.substr(-1);
            if (number == 0) {
                term = $scope.courseProgress.translations[0];
            }
            if (number == 1) {
                term = $scope.courseProgress.translations[1];
            }
            if (number > 1 && number <= 4) {
                term = $scope.courseProgress.translations[2];
            }
            if (number > 4) {
                term = $scope.courseProgress.translations[0];
            }
        }
        return term;
    };

    $scope.redirectToCabinet=function (scenario,id,selectedScheme) {
        location.href = basePath + '/cabinet#/'+scenario+'/'+id+'/'+selectedScheme.educForm+'/scheme/'+selectedScheme.schemeId;
    };

    //redirect to module page
    $scope.moduleLink = function (idModule,idCourse) {
        $http({
            url: basePath + '/module/getModuleLink',
            method: "POST",
            data: $.param({idModule: idModule,idCourse: idCourse}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            window.location = response.data;
        }, function errorCallback() {
            return false;
        });
    };
}

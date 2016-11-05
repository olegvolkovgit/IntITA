/**
 * Created by Wizlight on 15.02.2016.
 */
angular
    .module('mainApp')
    .controller('moduleListCtrl',moduleListCtrl)
    .controller('courseSchemaCtrl',courseSchemaCtrl);

function moduleListCtrl($http,$scope) {
    var date = new Date();
    var currentTime=Math.round(date.getTime()/1000);
    $scope.getModuleProgressForUser=function (idCourse) {
        $('.modulesLoading').show();
        var promise = $http({
            url: basePath+'/course/modulesData',
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
        $scope.basePath=basePath;
        $scope.modulesProgress=response;
        if(!$scope.modulesProgress.userId){
            $scope.modulesProgress.ico='disabled.png';
        }else if(!$scope.modulesProgress.courseStatus)
            $scope.modulesProgress.ico='development.png';

        for(var i=0;i<$scope.modulesProgress.modules.length;i++){
            if(!$scope.modulesProgress.modules[i].access){
                $scope.modulesProgress.modules[i].ico='disabled.png';
            }else if(!$scope.modulesProgress.isAdmin && !$scope.modulesProgress.modules[i].isAuthor && $scope.modulesProgress.courseStatus){
                if(!($scope.modulesProgress.modules[i].startTime || $scope.modulesProgress.modules[i].finishTime)){
                    $scope.modulesProgress.modules[i].progress='inLine';
                    $scope.modulesProgress.modules[i].ico='future.png';
                }
                else if($scope.modulesProgress.modules[i].startTime && !$scope.modulesProgress.modules[i].finishTime){
                    $scope.modulesProgress.modules[i].progress='inProgress';
                    var days=Math.round((currentTime-$scope.modulesProgress.modules[i].startTime)/86400)+1;
                    if(days<=0) days=1;
                    $scope.modulesProgress.modules[i].spentTime=days;
                    $scope.modulesProgress.modules[i].ico='inProgress.png';
                }
                else if($scope.modulesProgress.modules[i].startTime && $scope.modulesProgress.modules[i].finishTime){
                    $scope.modulesProgress.modules[i].progress='finished';
                    var days=Math.round(($scope.modulesProgress.modules[i].finishTime-$scope.modulesProgress.modules[i].startTime)/86400)+1;
                    if(days<=0) days=1;
                    $scope.modulesProgress.modules[i].spentTime=days;
                    $scope.modulesProgress.modules[i].ico='finished.png';
                }else if(!$scope.modulesProgress.modules[i].startTime && $scope.modulesProgress.modules[i].finishTime){
                    $scope.modulesProgress.modules[i].progress='inLine';
                    $scope.modulesProgress.modules[i].ico='future.png';
                }
            }
        }
        if($scope.modulesProgress.modules.length>0)
        $scope.finishedCourse=true;
        for(var j = 0; j < $scope.modulesProgress.modules.length; j++){
            if($scope.modulesProgress.modules[j].ico!='finished.png'){
                $scope.finishedCourse=false;
                break;
            }
        }
        if($scope.finishedCourse){
            var fullTime=0;
            var recommendedTime=0;
            for(var j = 0; j < $scope.modulesProgress.modules.length; j++){
                fullTime=fullTime+$scope.modulesProgress.modules[j].spentTime;
                recommendedTime=recommendedTime+$scope.modulesProgress.modules[j].time;
            }
            $scope.modulesProgress.fullTime=fullTime;
            $scope.modulesProgress.recommendedTime=recommendedTime;
        }

        $('.modulesLoading').hide();
        if($scope.modulesProgress.isAdmin){
            bootbox.addLocale('uk', { OK: 'Добре', CANCEL: 'Ні', CONFIRM: 'Так' });
            bootbox.addLocale('ru', { OK: 'Хорошо', CANCEL: 'Нет', CONFIRM: 'Да' });
            bootbox.addLocale('en', { OK: 'OK', CANCEL: 'Cancel', CONFIRM: 'Yes' });
            bootbox.setLocale(lang);
        }
    });
    $scope.daysTermination=function(day){
        day=day.toString();
        var number = day.substr(-2);
        var term;
        if (number > 10 && number < 15) {
            term = $scope.modulesProgress.termination[0];
        } else {
            number = number.substr(-1);
            if (number == 0) {
                term = $scope.modulesProgress.termination[0];
            }
            if (number == 1) {
                term = $scope.modulesProgress.termination[1];
            }
            if (number > 1 && number <= 4) {
                term = $scope.modulesProgress.termination[2];
            }
            if (number > 4) {
                term = $scope.modulesProgress.termination[0];
            }
        }
        return term;
    };
}

function courseSchemaCtrl(paymentsService,$scope) {
    paymentsService
        .scheme({courseId: idCourse,educationFormId:1})
        .$promise
        .then(function (data) {
            $scope.onlineSchemeData = data;
        });
    paymentsService
        .scheme({courseId: idCourse,educationFormId:2})
        .$promise
        .then(function (data) {
            $scope.offlineSchemeData = data;
        });

    $scope.paymentOnlineSpoiler=function (a,b) {
        if($scope.spoilerOnlineTitle==a+'\u25BC') {
            $scope.spoilerOnlineTitle=b+'\u25B2';
            $scope.isOpenOnlineSchema=true;
        } else {
            $scope.spoilerOnlineTitle=a+'\u25BC';
            $scope.isOpenOnlineSchema=false;
        }
    };
    $scope.paymentOfflineSpoiler=function (a,b) {
        if($scope.spoilerOfflineTitle==a+'\u25BC') {
            $scope.spoilerOfflineTitle=b+'\u25B2';
            $scope.isOpenOfflineSchema=true;
        } else {
            $scope.spoilerOfflineTitle=a+'\u25BC';
            $scope.isOpenOfflineSchema=false;
        }
    };

    $scope.redirectToCabinet=function (scenario,id) {
        if(typeof $scope.onlineSchemeData.selectedForm=='undefined' || typeof $scope.offlineSchemeData.selectedForm=='undefined'){
            $scope.educationForm=1;
            $scope.schemeType=1;
        }else{
            $scope.educationForm=$scope.onlineSchemeData.selectedForm?1:2;
            $scope.schemeType=$scope.onlineSchemeData.selectedSchemeType?$scope.onlineSchemeData.selectedSchemeType:$scope.offlineSchemeData.selectedSchemeType;
        }

        location.href = basePath + '/cabinet#/'+scenario+'/'+id+'/educationForm/'+$scope.educationForm+'/scheme/'+$scope.schemeType;
    };

    $('html').on('click','.paymentPlan_value',function () {
        $('img.icoCheck').hide();
        $('img.icoNoCheck').show();
        $(this).next('span').find('img.icoNoCheck').hide();
        $(this).next('span').find('img.icoCheck').show();
    });
}

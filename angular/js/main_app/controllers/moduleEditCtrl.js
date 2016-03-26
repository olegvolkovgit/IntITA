/**
 * Created by Wizlight on 15.02.2016.
 */
angular
    .module('mainApp')
    .controller('moduleEditCtrl',moduleEditCtrl)

function moduleEditCtrl($http,$scope) {
    $scope.getModuleData=function (idModule) {
        $('#moduleLoading').show();
        var promise = $http({
            url: basePath+'/module/moduleData',
            method: "POST",
            data: $.param({id: idModule, course: idCourse}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return response.data;
        }, function errorCallback() {
            return false;
        });
        return promise;
    };
    $scope.getModuleData(idModule).then(function (response) {
        $scope.lectures=response;
        for(var i=0;i<$scope.lectures.rawData.length;i++){
            if($scope.lectures.rawData[i]['title_'+lang]=='')
                $scope.lectures.rawData[i].title=$scope.lectures.rawData[i].title_ua;
            else $scope.lectures.rawData[i].title=$scope.lectures.rawData[i]['title_'+lang];
        }
        $('#moduleLoading').hide();
    });

    $scope.upLecture=function (idLecture, idModule) {
        $('#lessonForm').hide();
        $http({
            url: basePath+'/module/upLesson',
            method: "POST",
            data: $.param({idLecture: idLecture,idModule: idModule}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback() {
            $scope.getModuleData(idModule).then(function (response) {
                $scope.lectures=response;
                for(var i=0;i<$scope.lectures.rawData.length;i++){
                    if($scope.lectures.rawData[i]['title_'+lang]=='')
                        $scope.lectures.rawData[i].title=$scope.lectures.rawData[i].title_ua;
                    else $scope.lectures.rawData[i].title=$scope.lectures.rawData[i]['title_'+lang];
                }
                $('#moduleLoading').hide();
            });
        }, function errorCallback() {
            bootbox.alert('Не вдалось перемістити заняття');
        });
    };
    $scope.downLecture=function (idLecture, idModule) {
        $('#lessonForm').hide();
        $http({
            url: basePath+'/module/downLesson',
            method: "POST",
            data: $.param({idLecture: idLecture,idModule: idModule}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback() {
            $scope.getModuleData(idModule).then(function (response) {
                $scope.lectures=response;
                for(var i=0;i<$scope.lectures.rawData.length;i++){
                    if($scope.lectures.rawData[i]['title_'+lang]=='')
                        $scope.lectures.rawData[i].title=$scope.lectures.rawData[i].title_ua;
                    else $scope.lectures.rawData[i].title=$scope.lectures.rawData[i]['title_'+lang];
                }
                $('#moduleLoading').hide();
            });
        }, function errorCallback() {
            bootbox.alert('Не вдалось перемістити заняття');
        });
    }
    $scope.deleteLecture=function (idLecture, idModule) {
        $('#lessonForm').hide();
        var msg;
        switch (lang) {
            case 'ua':
                msg='Ти впевнений, що хочеш видалити дане заняття?';
                break;
            case 'ru':
                msg='Ты уверен, что хочешь удалить данное занятие?';
                break;
            case 'en':
                msg='Are you sure you want to remove this lecture?';
                break;
            default:
                msg='Ти впевнений, що хочеш видалити дане заняття?';
                break;
        }

        bootbox.confirm(msg, function(result){
            if(result){
                $http({
                    url: basePath+'/revision/DeleteLecture',
                    method: "POST",
                    data: $.param({idLecture: idLecture,idModule: idModule}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback() {
                    $scope.getModuleData(idModule).then(function (response) {
                        $scope.lectures=response;
                        for(var i=0;i<$scope.lectures.rawData.length;i++){
                            if($scope.lectures.rawData[i]['title_'+lang]=='')
                                $scope.lectures.rawData[i].title=$scope.lectures.rawData[i].title_ua;
                            else $scope.lectures.rawData[i].title=$scope.lectures.rawData[i]['title_'+lang];
                        }
                        $('#moduleLoading').hide();
                    });
                }, function errorCallback() {
                    bootbox.alert('Не вдалось дезактивувати заняття');
                });
            };
        })
    };

    $scope.showForm=function () {
        document.getElementById('lessonForm').style.display = 'block';
        $('html, body').animate({
            scrollTop: $("#titleUa").offset().top
        }, 1000);
    };
    $scope.hideForm=function (id) {
        $form = document.getElementById(id);
        $form.style.display = 'none';
    }
}

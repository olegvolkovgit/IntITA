/**
 * Created by adm on 01.09.2016.
 */
angular
    .module('teacherApp')
    .controller('payCtrl',payCtrl);

function payCtrl ($scope, $http, typeAhead, $state){

    $scope.user = null;
    $scope.module = null;
    $scope.course = null;
    $scope.getUsers = function(value){
        return typeAhead.getData(basePath+'/_teacher/cabinet/usersByQuery',{query : value});
    };

    $scope.getModules = function(value){
        return typeAhead.getData(basePath+'/_teacher/_admin/teachers/modulesByQuery',{query : value});
    };

    $scope.getCourses = function(value){
        return typeAhead.getData(basePath+'/_teacher/_admin/pay/coursesByQuery',{query : value});
    };

    $scope.selectModule = function(item){
        $scope.module = item;
    };

    $scope.selectUser = function(item){
        $scope.user = item;
    };

    $scope.selectCourse = function(item){
        $scope.course = item;
    };

    $scope.actionModule = function(action) {
        var url;
        switch (action){
            case 'payModule':
                url = basePath+'/_teacher/_admin/pay/payModule/';
                break;
            case 'cancelModule':
                url = basePath+'/_teacher/_admin/pay/cancelModule/';
                break;

        }
        if ($scope.module && $scope.user) {
            $http({
                method:'POST',
                url:url,
                data: $jq.param({'module': $scope.module.id, 'user': $scope.user.id}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            })
                .success(function(data){
                    bootbox.alert(data,function(){
                       $state.reload();
                    });
                })
                .error(function(data){
                    bootbox.alert(data);
                })
        }
    };

    $scope.actionCourse = function(action){
        var url;
        switch (action){
            case 'payCourse':
                url = basePath+'/_teacher/_admin/pay/payCourse/';
                break;
            case 'cancelCourse':
                url = basePath+'/_teacher/_admin/pay/cancelCourse/';
                break;

        }
        if ($scope.course && $scope.user) {
            $http({
                method:'POST',
                url:url,
                data: $jq.param({'course': $scope.course.id, 'user': $scope.user.id}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            })
                .success(function(data){
                    bootbox.alert(data,function(){
                        $state.reload();
                    });
                })
                .error(function(data){
                    bootbox.alert(data);
                })
        }
    }
}
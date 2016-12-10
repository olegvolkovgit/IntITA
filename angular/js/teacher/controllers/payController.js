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

    $scope.selectModule = function(item){
        $scope.module = item;
    };

    $scope.selectUser = function(item){
        $scope.user = item;
    };

    $scope.selectCourse = function(item){
        $scope.course = item;
    };

    $scope.reloadUser = function(){
        $scope.user=null;
    };

    $scope.reloadModule = function(){
        $scope.module=null;
    };

    $scope.reloadCourse = function(){
        $scope.course=null;
    };

    $scope.clearModule= function(){
        $scope.selectedModule=null;
        $scope.module=null;
    };

    $scope.clearCourse= function(){
        $scope.selectedCourse=null;
        $scope.course=null;
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
                    $scope.addUIHandlers(data);
                    $scope.clearModule();
                })
                .error(function(data){
                    bootbox.alert(data);
                })
        }else{
            bootbox.alert('Користувача або модуль не вибрано');
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
                    $scope.addUIHandlers(data);
                    $scope.clearCourse();
                })
                .error(function(data){
                    bootbox.alert(data);
                })
        }else{
            bootbox.alert('Користувача або курс не вибрано');
        }
    }
}
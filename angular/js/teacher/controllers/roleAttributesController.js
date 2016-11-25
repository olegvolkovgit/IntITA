/**
 * Created by adm on 31.08.2016.
 */

angular.module('teacherApp')
    .controller('roleAttributesCtrl',roleAttributesCtrl);

function roleAttributesCtrl ($scope, $http, $stateParams, roleAttributeService){
    $scope.changePageHeader('Атрибути ролі');
    $scope.formData = {};
    if(typeof $stateParams.moduleId!='undefined'){
        $scope.defaultModule=true;
        $http({
            method:'POST',
            url: basePath + "/_teacher/cabinet/modulesTitleById",
            data: $jq.param({
                'moduleId': $stateParams.moduleId,
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
        }).then(function successCallback(response) {
            $scope.selectedModule=response.data;
            $scope.formData.moduleSelected=response.data.title;
        }, function errorCallback(response) {
            console.log(response);
            bootbox.alert("Завантажити дані модуля не вдалося");
        });
    }

    $scope.clearInputs=function () {
        if($scope.defaultModule){
            $scope.userSelected=null;
            $scope.selectedUserSet=null;
        }else{
            $scope.formData.moduleSelected=null;
            $scope.selectedModule=null;
        }
    };
    $scope.onSelectUserSet = function ($item) {
        $scope.selectedUserSet = $item;
    };
    $scope.onSelectUserUnset = function ($item) {
        $scope.selectedUserUnset = $item;
    };
    
    $scope.onSelectModule = function ($item) {
        $scope.selectedModule = $item;
    };

    $scope.reloadUserSet = function(){
        $scope.selectedUserSet=null;
    };
    $scope.reloadUserUnset = function(){
        $scope.selectedUserUnset=null;
        $scope.userModules=null;
    };
    
    $scope.reloadModule = function(){
        $scope.selectedModule=null;
    };

    // params: role, role's attribute, users's id, attribute's id
    $scope.setTeacherRoleAttribute = function(role, attribute, userId, attributeId){
        if (attributeId && userId){
            roleAttributeService
                .setRoleAttribute({
                    'attribute': attribute,
                    'attributeValue':attributeId,
                    'role': role,
                    'userId' : userId
                })
                .$promise
                .then(function successCallback(response) {
                    if(response.data=='success')
                        $scope.addUIHandlers('Операцію успішно виконано');
                    else $scope.addUIHandlers(response.data);
                    $scope.clearInputs();
                }, function errorCallback(response) {
                    console.log(response);
                    bootbox.alert("Операцію не вдалося виконати");
                });
        }else{
            bootbox.alert("Користувача або модуль не вибрано");
        }
    };

    // params: role, role's attribute, users's id, attribute's id
    $scope.cancelTeacherRoleAttribute = function(role, attribute, userId, attributeId){
        if (attributeId && userId){
            roleAttributeService
                .unsetRoleAttribute({
                    'attribute': attribute,
                    'attributeValue':attributeId,
                    'role': role,
                    'userId' : userId
                })
                .$promise
                .then(function successCallback(response) {
                    if(response.data=='success')
                        $scope.addUIHandlers('Операцію успішно виконано');
                    else $scope.addUIHandlers(response.data);
                    $scope.showModulesByRole(role,$scope.selectedUserUnset);
                }, function errorCallback(data) {
                    console.log(data);
                    bootbox.alert("Операцію не вдалося виконати");
                });
        }else{
            bootbox.alert("Введено не всі дані");
        }

    };

    //params: role, $item - user model
    $scope.showModulesByRole = function(role,$item){
        $scope.selectedUserUnset = $item;
        $http({
            method:'POST',
            url: basePath + "/_teacher/cabinet/modulesListByRole",
            data: $jq.param({'user': $scope.selectedUserUnset.id,'role':role }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
        }).then(function successCallback(response) {
            $scope.userModules = response.data.value;
        }, function errorCallback(data) {
            console.log(data);
            bootbox.alert("Виникла помилка при завантаженні модулів користувача");
        })
    };
}

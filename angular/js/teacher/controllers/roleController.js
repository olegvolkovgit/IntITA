/**
 * Created by adm on 31.08.2016.
 */

angular.module('teacherApp')
    .controller('roleCtrl',roleCtrl)

function roleCtrl ($scope, roleService, organizationService){
    $scope.changePageHeader('Призначити роль');

    $scope.loadOrganizationsList=function(){
        var promise = organizationService.organizationsList().$promise.then(
            function successCallback(response) {
                $scope.organizations=response.rows;
            }, function errorCallback() {
                bootbox.alert("Отримати список організацій не вдалося");
            });
        return promise;
    };
    $scope.loadOrganizationsList().then(function (data) {$scope.organization=data});

    $scope.onSelectUser = function ($item) {
        $scope.selectedUser = $item;
    };
    $scope.reloadUser = function(){
        $scope.selectedUser=null;
    };
    $scope.clearInputs=function () {
        $scope.userSelected=null;
        $scope.selectedUser=null;
    };

    $scope.assignLocalRole = function (user, role, organization) {
        if (!user) {
            bootbox.alert('Виберіть користувача.');
        } else {
            roleService
                .assignLocalRole({
                    'userId': user,
                    'role': role,
                    'organizationId': organization,
                })
                .$promise
                .then(function successCallback(response) {
                    $scope.addUIHandlers(response.data);
                    $scope.clearInputs();
                }, function errorCallback(response) {
                    console.log(response);
                    bootbox.alert("Операцію не вдалося виконати");
                });
        }
    }

    $scope.assignRoleByDirector = function (user, role, organization) {
        if (!user) {
            bootbox.alert('Виберіть користувача.');
        } else {
            roleService
                .assignRoleByDirector({
                    'userId': user,
                    'role': role,
                    'organizationId': organization,
                })
                .$promise
                .then(function successCallback(response) {
                    $scope.addUIHandlers(response.data);
                    $scope.clearInputs();
                }, function errorCallback(response) {
                    console.log(response);
                    bootbox.alert("Операцію не вдалося виконати");
                });
        }
    }
}

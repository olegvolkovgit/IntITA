/**
 * Created by adm on 19.07.2016.
 */

angular
    .module('teacherApp')
    .controller('organizationTableCtrl', organizationTableCtrl)
    .controller('organizationCtrl', organizationCtrl)

function organizationTableCtrl ($scope, organizationService, NgTableParams){
    $scope.changePageHeader('Організації');

    $scope.organizationsTableParams = new NgTableParams({}, {
        getData: function (params) {
            return organizationService
                .organizationsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
}

function organizationCtrl ($scope, organizationService, $state, $stateParams){
    $scope.changePageHeader('Організація');

    $scope.loadOrganizationData=function(){
        var promise = organizationService.organizationData({'id':$stateParams.id}).$promise.then(
            function successCallback(response) {
                return response.data;
            }, function errorCallback() {
                bootbox.alert("Отримати дані організації не вдалося");
            });
        return promise;
    };
    if($stateParams.id)  $scope.loadOrganizationData().then(function (data) {$scope.organization=data});

    $scope.sendFormOrganization= function (scenario) {
        if(scenario=='new') $scope.createOrganization();
        else $scope.updateOrganization();
    };
    $scope.createOrganization= function () {
        organizationService.create($scope.organization).$promise.then(function (data) {
            if (data.message === 'OK') {
                bootbox.alert('Організацію успішно створено',function () {
                    $state.go("organizations", {}, {reload: true});
                });
            } else {
                bootbox.alert('Під час створення організації виникла помилка');
            }
        });
    };
    $scope.updateOrganization= function () {
        organizationService.update($scope.organization).$promise.then(function (data) {
            if (data.message === 'OK') {
                bootbox.alert('Організацію успішно оновлено',function () {
                    $state.reload();
                });
            } else {
                bootbox.alert('Під час оновлення організації виникла помилка');
            }
        });
    };
}
/**
 * Created by adm on 19.07.2016.
 */
angular
    .module('teacherApp')
    .controller('superVisorCtrl', superVisorCtrl)
    .controller('offlineGroupsTableCtrl', offlineGroupsTableCtrl)
    .controller('addOfflineGroupCtrl', addOfflineGroupCtrl)
    .controller('editOfflineGroupCtrl', editOfflineGroupCtrl);

function superVisorCtrl (){

}

function offlineGroupsTableCtrl ($scope, superVisorService, NgTableParams){
    $scope.offlineGroupsTableParams = new NgTableParams({}, {
        getData: function (params) {
            return superVisorService
                .offlineGroupsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
}

function addOfflineGroupCtrl ($scope, superVisorService, $state, $http){
    $scope.changePageHeader('Нова оффлайн група');
    $scope.loadSpecializations=function(){
        return superVisorService
            .getSpecializationsList()
            .$promise
            .then(function (data) {
                $scope.specializations=data;
            });
    };
    
    $scope.loadSpecializations();
    
    $scope.createOfflineGroup= function () {
        if($jq('#city').val()==0){
            bootbox.alert('Виберіть місто з існуючого списку');
            return;
        }

        $http({
            url: basePath+'/_teacher/_super_visor/superVisor/createOfflineGroup',
            method: "POST",
            data: $jq.param({name: $scope.name,date:$scope.startDate,specialization:$scope.selectedSpecialization.id,city:$jq('#city').val()}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data, function(){
                $state.go("offline_groups", {}, {reload: true});
            });
        }, function errorCallback() {
            bootbox.alert("Створити групу не вдалося. Помилка сервера.");
        });
    };
}

function editOfflineGroupCtrl ($scope, superVisorService, $state, $http, $stateParams){
    $scope.changePageHeader('Оффлайн група');
    $scope.loadSpecializations=function(){
        return superVisorService
            .getSpecializationsList()
            .$promise
            .then(function (data) {
                $scope.specializations=data;
                $scope.loadGroupData();
            });
    };
    $scope.loadGroupData=function(){
        $http({
            url: basePath+'/_teacher/_super_visor/superVisor/getGroupData',
            method: "POST",
            data: $jq.param({id:$stateParams.id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            $scope.group=response.data;
            $scope.selectedSpecialization=$scope.specializations[$scope.group.specialization-1].id;
        }, function errorCallback() {
            bootbox.alert("Отримати дані групи не вдалося");
        });
    };

    $scope.loadSpecializations();
    
    $scope.editOfflineGroup= function () {
        // if($jq('#city').val()==0){
        //     bootbox.alert('Виберіть місто з існуючого списку');
        //     return;
        // }
        $http({
            url: basePath+'/_teacher/_super_visor/superVisor/updateOfflineGroup',
            method: "POST",
            data: $jq.param({id:$stateParams.id,name: $scope.group.name,date:$scope.group.start_date,specialization:$scope.selectedSpecialization,city:$jq('#city').val()}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data, function(){
                $state.go("offline_groups", {}, {reload: true});
            });
        }, function errorCallback() {
            bootbox.alert("Створити групу не вдалося. Помилка сервера.");
        });
    };
}
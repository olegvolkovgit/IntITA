/**
 * Created by adm on 19.07.2016.
 */
angular
    .module('teacherApp')
    .controller('specializationsTableCtrl', specializationsTableCtrl)
    .controller('specializationCtrl', specializationCtrl)

function specializationsTableCtrl ($scope, siteConfig, $state, $http){
    $scope.changePageHeader('Спеціалізації груп');

    $scope.loadSpecializations=function(){
        return siteConfig
            .getSpecializationsList()
            .$promise
            .then(function (data) {
                $scope.specializations=data;
            });
    };
    $scope.loadSpecializations();

    $scope.createSpecialization= function () {
        $http({
            url: basePath+'/_teacher/_super_admin/config/createSpecialization',
            method: "POST",
            data: $jq.param({title_ua: $scope.specialization.title_ua,title_ru: $scope.specialization.title_ru,title_en: $scope.specialization.title_en}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data, function(){
                $state.go("configuration/specializations", {}, {reload: true});
            });
        }, function errorCallback() {
            bootbox.alert("Створити спеціалізацію не вдалося. Помилка сервера.");
        });
    };
}

function specializationCtrl ($scope, $state, $http, $stateParams){
    $scope.changePageHeader('Спеціалізація');

    $scope.loadSpecializationData=function(){
        $http({
            url: basePath+'/_teacher/_super_admin/config/getSpecializationData',
            method: "POST",
            data: $jq.param({id:$stateParams.id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            $scope.specialization=response.data;
        }, function errorCallback() {
            bootbox.alert("Отримати дані спеціалізації не вдалося");
        });
    };
    $scope.loadSpecializationData();

    $scope.editSpecialization= function () {
        $http({
            url: basePath+'/_teacher/_super_admin/config/updateSpecialization',
            method: "POST",
            data: $jq.param({
                id:$stateParams.id,
                title_ua: $scope.specialization.title_ua,
                title_ru: $scope.specialization.title_ru,
                title_en: $scope.specialization.title_en
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data, function(){
                $state.go("configuration/specializations", {}, {reload: true});
            });
        }, function errorCallback() {
            bootbox.alert("Відредагувати спеціалізацію не вдалося. Помилка сервера.");
        });
    };
}
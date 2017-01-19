/**
 * Created by adm on 19.07.2016.
 */
angular
    .module('teacherApp')
    .controller('careerStartTableCtrl', careerStartTableCtrl)
    .controller('careerStartCtrl', careerStartCtrl);

function careerStartTableCtrl ($scope, careerService, $state, $http){
    $scope.changePageHeader("Варіанти кар'єри в IT");

    $scope.loadCareers=function(){
        return careerService
            .getCareersList()
            .$promise
            .then(function (data) {
                $scope.careers=data;
            });
    };
    $scope.loadCareers();

    $scope.createCareer= function () {
        $http({
            url: basePath+'/_teacher/_admin/config/createCareer',
            method: "POST",
            data: $jq.param({
                title_ua: $scope.career.title_ua,
                title_ru: $scope.career.title_ru,
                title_en: $scope.career.title_en
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data, function(){
                $state.go("configuration/careers", {}, {reload: true});
            });
        }, function errorCallback() {
            bootbox.alert("Створити варіфант кар'єри для IT не вдалося. Помилка сервера.");
        });
    };
}

function careerStartCtrl ($scope, $state, $http, $stateParams){
    $scope.changePageHeader("Кар'єра");
    
    $scope.loadCareerData=function(){
        $http({
            url: basePath+'/_teacher/_admin/config/getCareerData',
            method: "POST",
            data: $jq.param({id:$stateParams.id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            $scope.career=response.data;
        }, function errorCallback() {
            bootbox.alert("Отримати дані кар'єри не вдалося");
        });
    };
    $scope.loadCareerData();

    $scope.editCareer= function () {
        $http({
            url: basePath+'/_teacher/_admin/config/updateCareer',
            method: "POST",
            data: $jq.param({
                id:$stateParams.id,
                title_ua: $scope.career.title_ua,
                title_ru: $scope.career.title_ru,
                title_en: $scope.career.title_en
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data, function(){
                $state.go("configuration/careers", {}, {reload: true});
            });
        }, function errorCallback() {
            bootbox.alert("Відредагувати кар'єру не вдалося. Помилка сервера.");
        });
    };
}

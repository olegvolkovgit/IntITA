/**
 * Created by adm on 26.07.2016.
 */
angular
    .module('superVisorRouter', ['ui.router']).
config(function ($stateProvider) {
    $stateProvider
        .state('supervisor', {
            url: "/supervisor",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Supervisor');
            },
            templateUrl: basePath+"/_teacher/cabinet/loadPage/?page=super_visor",
        })
        .state('offline_groups', {
            url: "/offline_groups",
            cache: false,
            controller: function ($scope) {
                $scope.changePageHeader('Оффлайнові групи');
            },
            templateUrl: basePath + "/_teacher/_super_visor/superVisor/offlineGroups",
        })
        .state('offline_subgroups', {
            url: "/offline_subgroups",
            cache: false,
            controller: function ($scope) {
                $scope.changePageHeader('Оффлайнові підгрупи');
            },
            templateUrl: basePath + "/_teacher/_super_visor/superVisor/offlineSubgroups",
        })
        .state('offline_students', {
            url: "/offline_students",
            cache: false,
            controller: function ($scope) {
                $scope.changePageHeader('Студенти(оффлайнова форма навчання)');
            },
            templateUrl: basePath + "/_teacher/_super_visor/superVisor/offlineStudents",
        })
        .state('supervisor/addOfflineGroup', {
            url: "/supervisor/addOfflineGroup",
            cache: false,
            controller: 'addOfflineGroupCtrl',
            templateUrl: basePath + "/_teacher/_super_visor/superVisor/addNewOfflineGroupForm",
        })
        .state('supervisor/editOfflineGroup/:id', {
            url: "/supervisor/editOfflineGroup/:id",
            cache: false,
            controller: 'editOfflineGroupCtrl',
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_super_visor/superVisor/editOfflineGroupForm/?id=" + $stateParams.id
            }
        })
});
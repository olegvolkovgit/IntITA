/**
 * Created by adm on 26.07.2016.
 */
angular
    .module('consultantRouter',['ui.router']).
config(function ($stateProvider, $urlRouterProvider, $locationProvider) {
    $stateProvider
        .state('consultant', {
            url: "/consultant",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Консультант');
            },
            templateUrl: basePath+"/_teacher/cabinet/loadPage/?page=consultant",
        })
        .state('consultant/modules', {
            url: "/consultant/modules",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Модулі');
            },
            templateUrl: basePath+"/_teacher/_consultant/consultant/modules/id/"+user,
        })
        .state('consultant/consultations', {
            url: "/consultant/consultations",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Консультації');
            },
            templateUrl: basePath+"/_teacher/_consultant/consultant/consultations/id/"+user,
        })
});

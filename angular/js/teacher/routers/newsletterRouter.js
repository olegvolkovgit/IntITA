/**
 * Created by adm on 13.11.2016.
 */
angular
    .module('newsletterRouter',['ui.router']).
config(function ($stateProvider, $urlRouterProvider, $locationProvider) {
    $stateProvider
        .state('newsletter/create', {
            url: "/newsletter/create",
            cache: false,
            controller: function ($scope) {
                $scope.changePageHeader('Створити розсилку');
            },
            templateUrl: "/_teacher/newsletter/index",
        })
        .state('newsletter/templates', {
            url: "/newsletter/templates",
            cache: false,
            controller: function ($scope) {
                $scope.changePageHeader('Керування шаблонами електронних листів');
            },
            templateUrl: "/_teacher/mailTemplates/index",
        })
});
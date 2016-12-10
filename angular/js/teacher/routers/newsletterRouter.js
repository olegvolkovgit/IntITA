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
            templateUrl: basePath+"/_teacher/newsletter/index",
        })
        .state('newsletter/templates', {
            url: "/newsletter/templates",
            cache: false,
            controller: function ($scope) {
                $scope.changePageHeader('Керування шаблонами електронних листів');
            },
            templateUrl: "/_teacher/mailTemplates/index",
        })
        .state('newsletter/template/create', {
            url: "/newsletter/template/create",
            cache: false,
            controller: function ($scope) {
                $scope.changePageHeader('Створення шаблону електронного листа');
            },
            templateUrl: "/_teacher/mailTemplates/create",
        })
        .state('newsletter/template/edit/:id', {
            url: "/newsletter/template/edit/:id",
            cache: false,
            controller: function ($scope) {
                $scope.changePageHeader('Редагування шаблону електронного листа');
            },
            templateUrl: function($stateParams){
                return "/_teacher/mailTemplates/update/id/"+$stateParams.id
            }
        })
        .state('newsletter/template/view/:id', {
            url: "/newsletter/template/view/:id",
            cache: false,
            controller: function ($scope) {
                $scope.changePageHeader('Перегляд шаблону електронного листа');
            },
            templateUrl: function($stateParams){
                return "/_teacher/mailTemplates/view/id/"+$stateParams.id
            }
        })
});
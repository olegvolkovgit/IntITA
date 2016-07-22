/**
 * Created by adm on 19.07.2016.
 */
var contentManagerUrl = "/_teacher/_accountant/";

angular
    .module('contentManagerRouter',['ui.router']).
config(function ($stateProvider, $urlRouterProvider) {
    $stateProvider
        .state('content_manager', {
        url: "/content_manager",
        cache         : false,
        templateUrl: "/_teacher/cabinet/loadPage/?page=content_manager",
        })
        .state('content_manager/authors', {
            url: "/content_manager/authors",
            cache         : false,
            templateUrl: "/_teacher/_content_manager/contentManager/authors",
        })
        .state('content_manager/consultants', {
            url: "/content_manager/consultants",
            cache         : false,
            templateUrl: "/_teacher/_content_manager/contentManager/consultants",
        })
        .state('content_manager/teacherConsultants', {
            url: "/content_manager/teacherConsultants",
            cache         : false,
            templateUrl: "/_teacher/_content_manager/contentManager/teacherConsultants",
        })
        .state('content_manager/revisions', {
            url: "/content_manager/revisions",
            cache         : false,
            templateUrl: "/revision/index",
        })
        .state('content_manager/statusOfModules', {
            url: "/content_manager/statusOfModules",
            cache         : false,
            templateUrl: "/_teacher/_content_manager/contentManager/statusOfModules/id/0",
        })
        .state('content_manager/statusOfCourses', {
            url: "/content_manager/statusOfCourses",
            cache         : false,
            templateUrl: "/_teacher/_content_manager/contentManager/statusOfCourses",
        })
        .state('content_manager/statusOfModules/detail', {
            url: '/content_manager/statusOfModules/:id',
            controller: function($scope, $stateParams) {
                // get the id
                $scope.id = $stateParams.id;

            }
        })
});
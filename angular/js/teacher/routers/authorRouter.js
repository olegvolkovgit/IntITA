/**
 * Created by adm on 26.07.2016.
 */
angular
    .module('authorRouter',['ui.router']).
config(function ($stateProvider, $urlRouterProvider, $locationProvider) {
    $stateProvider
        .state('author', {
            url: "/author",
            cache         : false,
            templateUrl: "/_teacher/cabinet/loadPage/?page=author",
        })
        .state('author/modules', {
            url: "/author/modules",
            cache         : false,
            templateUrl: "/_teacher/_author/author/modules/id/"+user,
        })
});

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
            templateUrl: "/_teacher/cabinet/loadPage/?page=consultant",
        })
        .state('consultant/modules', {
            url: "/consultant/modules",
            cache         : false,
            templateUrl: "/_teacher/_consultant/consultant/modules/id/"+user,
        })
        .state('consultant/consultations', {
            url: "/consultant/consultations",
            cache         : false,
            templateUrl: "/_teacher/_consultant/consultant/consultations/id/"+user,
        })
});

/**
 * Created by adm on 10.08.2016.
 */
angular
    .module('responseRouter',['ui.router']).
config(function ($stateProvider) {
    $stateProvider
        .state('response', {
            url: "/response",
            cache: false,
            templateUrl: "/_teacher/_admin/response/index",
        })
        .state('response/detail/:responseId', {
            url: "/response/detail/:responseId",
            cache: false,
            reload: true,
            templateUrl: function($stateParams){
                return '/_teacher/_admin/response/view/id/'+$stateParams.responseId
            }
        })
        .state('response/edit/:responseId', {
            url: "/response/edit/:responseId",
            cache: false,
            templateUrl: function($stateParams){
                return '/_teacher/_admin/response/update/id/'+$stateParams.responseId
            }
        })
});
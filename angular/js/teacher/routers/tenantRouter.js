/**
 * Created by adm on 26.07.2016.
 */
angular
    .module('tenantRouter',['ui.router']).
config(function ($stateProvider, $urlRouterProvider, $locationProvider) {
    $stateProvider
        .state('tenant', {
            url: "/tenant",
            cache         : false,
            templateUrl: "/_teacher/cabinet/loadPage/?page=tenant",
        })
        .state('tenant/bots', {
            url: "/tenant/bots",
            cache         : false,
            templateUrl: "/_teacher/_tenant/tenant/Bots",
        })
        .state('tenant/chats', {
            url: "/tenant/chats",
            cache         : false,
            templateUrl: "/_teacher/_tenant/tenant/SearchChats",
        })
        .state('tenant/phrases', {
            url: "/tenant/phrases",
            cache         : false,
            templateUrl: "/_teacher/_tenant/tenant/showPhrases",
        })
        .state('tenant/searchchat/:user1/:user2', {
            url: "/tenant/searchchat/:user1/:user2",
            cache         : false,
            templateUrl: function($stateParams){
                return "/_teacher/_tenant/tenant/ShowChats?user1="+$stateParams.user1+"&user2="+$stateParams.user2; }
        })

});


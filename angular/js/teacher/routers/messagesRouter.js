/**
 * Created by adm on 26.07.2016.
 */
angular
    .module('messagesRouter',['ui.router']).
config(function ($stateProvider, $urlRouterProvider, $locationProvider) {
    $stateProvider
        .state('dialog/:user1/:user2', {
            url: "/dialog/:user1/:user2",
            cache         : false,
            controller:"messagesCtrl",
            templateUrl: function($stateParams){
                return   basePath+'/_teacher/messages/dialog/?user1='+$stateParams.user1+'&user2='+$stateParams.user2
            },
        })
});

/**
 * Created by adm on 13.08.2016.
 */
angular
    .module('interfaceMessagesRouter',['ui.router']).
config(function ($stateProvider) {
    $stateProvider
        .state('interfacemessages', {
            url: "/interfacemessages",
            cache: false,
            controller: function($scope){
                $scope.changePageHeader('Інтерфейсні повідомлення');
            },
            templateUrl: basePath+"/_teacher/_admin/translate/index",
        })
        .state('interfacemessages/view/:id', {
            url: "/interfacemessages/view/:id",
            cache: false,
            templateUrl: function($stateParams){
                return basePath+'/_teacher/_admin/translate/view/id/'+$stateParams.id
            },
        })
        .state('interfacemessages/create', {
            url: "/interfacemessages/create",
            cache: false,
            templateUrl: basePath+"/_teacher/_admin/translate/create",
        })
        .state('interfacemessages/edit/:id', {
            url: "/interfacemessages/edit/:id",
            cache: false,
            templateUrl: function($stateParams){
                return basePath+'/_teacher/_admin/translate/update/id/'+$stateParams.id
            },
        })
});
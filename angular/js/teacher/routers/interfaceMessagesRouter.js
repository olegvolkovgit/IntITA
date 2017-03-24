/**
 * Created by adm on 13.08.2016.
 */
var url=basePath+"/_teacher/_super_admin";

angular
    .module('interfaceMessagesRouter',['ui.router'])
    .config(function ($stateProvider) {
    $stateProvider
        .state('interfacemessages', {
            url: "/interfacemessages",
            cache: false,
            controller: function($scope){
                $scope.changePageHeader('Інтерфейсні повідомлення');
            },
            templateUrl: url+"/translate/index",
        })
        .state('interfacemessages/view/:id', {
            url: "/interfacemessages/view/:id",
            cache: false,
            templateUrl: function($stateParams){
                return url+'/translate/view/id/'+$stateParams.id
            },
        })
        .state('interfacemessages/create', {
            url: "/interfacemessages/create",
            cache: false,
            templateUrl: url+"/translate/create",
        })
        .state('interfacemessages/edit/:id', {
            url: "/interfacemessages/edit/:id",
            cache: false,
            templateUrl: function($stateParams){
                return url+"/translate/update/id/"+$stateParams.id
            },
        })
});
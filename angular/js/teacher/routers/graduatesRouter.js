/**
 * Created by adm on 10.08.2016.
 */
angular
    .module('graduatesRouter',['ui.router']).
config(function ($stateProvider) {
    $stateProvider
        .state('graduate', {
            url: "/graduate",
            cache: false,
            controller: function($scope){
                $scope.changePageHeader('Випускники');
            },
            templateUrl: basePath+"/_teacher/graduate/index",
        })
        .state('graduate/create', {
            url: "/graduate/create",
            cache: false,
            templateUrl: basePath+"/_teacher/graduate/create",
        })
        .state('graduate/view/:graduateId', {
            url: "/graduate/view/:graduateId",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+'/_teacher/graduate/view/id/'+$stateParams.graduateId
            }
        })
        .state('graduate/edit/:graduateId', {
            url: "/graduate/edit/:graduateId",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+'/_teacher/graduate/update/id/'+$stateParams.graduateId
            }
        })
});

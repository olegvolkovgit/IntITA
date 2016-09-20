/**
 * Created by adm on 20.09.2016.
 */
angular
    .module('requestsRouter',['ui.router']).
config(function ($stateProvider) {
    $stateProvider
        .state('requests', {
            url: "/requests",
            cache: false,
            controller: function ($scope) {
                $scope.changePageHeader('Всі запити');
            },
            templateUrl: basePath + "/_teacher/_admin/request/index",
        })
        .state('requests/message/:idRequest', {
            url: "/requests/message/:idRequest",
            cache: false,
            controller: function ($scope) {
                $scope.changePageHeader('Запит');
            },
            templateUrl: function($stateParams)
            {
                return basePath + "/_teacher/_admin/request/request/message/"+$stateParams.idRequest
            }

        })
});
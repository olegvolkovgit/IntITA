/**
 * Created by adm on 28.08.2016.
 */
angular
    .module('freeLecturesRouter',['ui.router']).
config(function ($stateProvider) {
    $stateProvider
        .state('admin/freelectures', {
            url: "/admin/freelectures",
            cache: false,
            controller: function($scope){
                $scope.changePageHeader('Безкоштовні заняття');
            },
            templateUrl: basePath + "/_teacher/_admin/freeLectures/index"
        })
});
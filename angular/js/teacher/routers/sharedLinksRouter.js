/**
 * Created by adm on 10.08.2016.
 */
angular
    .module('sharedLinksRouter',['ui.router']).
config(function ($stateProvider) {
    $stateProvider
        .state('sharedlinks', {
            url: '/sharedlinks',
            cache: false,
            controller: function($scope){
                $scope.changePageHeader('Ресурси для викладачів');
            },
            templateUrl: "/_teacher/_admin/shareLink/index"
        })
        .state('sharedlinks/detail/:linkId', {
            url: '/sharedlinks/detail/:linkId',
            cache: false,
            templateUrl: function($stateParams){
                return '/_teacher/_admin/shareLink/view/id/'+$stateParams.linkId
            }
        })
        .state('sharedlinks/create', {
            url: '/sharedlinks/create',
            cache: false,
            templateUrl: "/_teacher/_admin/shareLink/create"
        })
        .state('sharedlinks/edit/:linkId', {
            url: '/sharedlinks/edit/:linkId',
            cache: false,
            templateUrl: function($stateParams){
                return '/_teacher/_admin/shareLink/update/id/'+$stateParams.linkId
            }
        })
});
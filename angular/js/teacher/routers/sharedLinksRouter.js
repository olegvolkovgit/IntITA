/**
 * Created by adm on 10.08.2016.
 */
angular
    .module('sharedLinksRouter',['ui.router'])
    .config(function ($stateProvider) {
    $stateProvider
        .state('sharedlinks', {
            url: '/sharedlinks',
            cache: false,
            controller: function($scope){
                $scope.changePageHeader('Ресурси для співробітників');
            },
            templateUrl: basePath+"/_teacher/_supervisor/shareLink/index"
        })
        .state('sharedlinks/detail/:linkId', {
            url: '/sharedlinks/detail/:linkId',
            cache: false,
            templateUrl: function($stateParams){
                return basePath+'/_teacher/_supervisor/shareLink/view/id/'+$stateParams.linkId
            }
        })
        .state('sharedlinks/create', {
            url: '/sharedlinks/create',
            cache: false,
            templateUrl: basePath+"/_teacher/_supervisor/shareLink/create"
        })
        .state('sharedlinks/edit/:linkId', {
            url: '/sharedlinks/edit/:linkId',
            cache: false,
            templateUrl: function($stateParams){
                return basePath+'/_teacher/_supervisor/shareLink/update/id/'+$stateParams.linkId
            }
        })
});
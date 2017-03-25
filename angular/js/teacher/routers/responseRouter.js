/**
 * Created by adm on 10.08.2016.
 */
angular
    .module('responseRouter',['ui.router'])
    .config(function ($stateProvider) {
        var url=basePath+'/_teacher/_super_admin/response';
        $stateProvider
            .state('response', {
                url: "/response",
                cache: false,
                controller: function($scope){
                    $scope.changePageHeader('Відгуки про викладачів');
                },
                templateUrl: url+"/index",
            })
            .state('response/detail/:responseId', {
                url: "/response/detail/:responseId",
                cache: false,
                reload: true,
                templateUrl: function($stateParams){
                    return url+'/view/id/'+$stateParams.responseId
                }
            })
            .state('response/edit/:responseId', {
                url: "/response/edit/:responseId",
                cache: false,
                templateUrl: function($stateParams){
                    return url+'/update/id/'+$stateParams.responseId
                }
            })
});
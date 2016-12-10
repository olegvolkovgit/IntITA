/**
 * Created by adm on 23.08.2016.
 */
angular
    .module('siteConfigRouter',['ui.router']).
config(function ($stateProvider) {
    $stateProvider
        .state('configuration/refreshcache', {
            url: "/configuration/refreshcache",
            cache: false,
            controller: function ($stateParams, $http, $state) {
                var url = basePath+"/_teacher/_admin/config/refresh";
                        $http.get(url).success(function(data) {
                            if (data === 'success')
                            bootbox.alert("Кеш успішно оновлено.", function () {
                                $state.go("index", {}, {reload: true});
                            })
                        }).error(function(data){
                            showDialog("Операцію не вдалося виконати.");
                        });
                }
        })
        .state('configuration/levels/edit/:levelId', {
            url: "/configuration/levels/edit/:levelId",
            cache: false,
            templateUrl: function($stateParams){
                return basePath + '/_teacher/_admin/level/edit/id/'+$stateParams.levelId
            }
        })
        .state('configuration/levels', {
            url: "/configuration/levels",
            cache: false,
            controller: function($scope){
                $scope.changePageHeader('Рівні курсів, модулів');
            },
            templateUrl: basePath + "/_teacher/_admin/level/index",
        })
        .state('configuration/siteconfig', {
            url: "/configuration/siteconfig",
            cache: false,
            controller: function($scope){
                $scope.changePageHeader('Налаштування ');
            },
            templateUrl: basePath + "/_teacher/_admin/config/index",
        })
        .state('configuration/siteconfig/view/:id', {
            url: "/configuration/siteconfig/view/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/config/view/id/"+$stateParams.id;
            }
        })
        .state('configuration/siteconfig/edit/:paramId', {
            url: "/configuration/siteconfig/edit/:paramId",
            cache: false,
            templateUrl: function ($stateParams) {
                console.log($stateParams.paramId);
                return basePath+"/_teacher/_admin/config/update/id/"+$stateParams.paramId;
        }
        })
});
/**
 * Created by adm on 23.08.2016.
 */

angular
    .module('siteConfigRouter',['ui.router'])
    .config(function ($stateProvider) {
        var url = basePath+"/_teacher/_super_admin/config";
        $stateProvider
            .state('configuration/refreshcache', {
                url: "/configuration/refreshcache",
                cache: false,
                controller: function ($stateParams, $http, $state) {
                    $http.get(url+"/refresh").success(function(data) {
                        if (data === 'success')
                        bootbox.alert("Кеш успішно оновлено.", function () {
                            window.history.back();
                        })
                    }).error(function(){
                        bootbox.alert("Операцію не вдалося виконати.");
                    });
                }
            })
            .state('configuration/levels/edit/:levelId', {
                url: "/configuration/levels/edit/:levelId",
                cache: false,
                templateUrl: function($stateParams){
                    return basePath + '/_teacher/_super_admin/level/edit/id/'+$stateParams.levelId
                }
            })
            .state('configuration/levels', {
                url: "/configuration/levels",
                cache: false,
                templateUrl: basePath + "/_teacher/_super_admin/level/index",
            })
            .state('configuration/siteconfig', {
                url: "/configuration/siteconfig",
                cache: false,
                templateUrl: url+"/index",
            })
            .state('configuration/siteconfig/view/:id', {
                url: "/configuration/siteconfig/view/:id",
                cache: false,
                controller: function($scope){
                    $scope.changePageHeader('Налаштування');
                },
                templateUrl: function ($stateParams) {
                    return url+"/view/id/"+$stateParams.id;
                }
            })
            .state('configuration/siteconfig/edit/:paramId', {
                url: "/configuration/siteconfig/edit/:paramId",
                cache: false,
                controller: function($scope){
                    $scope.changePageHeader('Налаштування');
                },
                templateUrl: function ($stateParams) {
                    return url+"/update/id/"+$stateParams.paramId;
                }
            })
            .state('configuration/careers', {
                url: "/configuration/careers",
                cache: false,
                templateUrl: url+"/careers",
            })
            .state('configuration/careers/update/:id', {
                url: "/configuration/careers/update/:id",
                cache: false,
                templateUrl: function ($stateParams) {
                    return url+"/careerUpdate/id/"+$stateParams.id;
                }
            })
            .state('configuration/createcareer', {
                url: "/configuration/createcareer",
                cache: false,
                templateUrl: url+"/careerCreate"
            })
});
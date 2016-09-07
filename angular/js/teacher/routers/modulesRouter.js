/**
 * Created by adm on 08.08.2016.
 */
angular
    .module('modulesRouter',['ui.router']).
config(function ($stateProvider) {
    $stateProvider
        .state('modulemanage', {
            url: "/modulemanage",
            cache: false,
            controller: function($scope){
                $scope.changePageHeader('Модулі');
            },
            templateUrl: basePath+"/_teacher/_admin/module/index",
        })
        .state('module/addTeacher/id/:id', {
            url: "/module/addTeacher/id/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/module/addTeacher/id/"+$stateParams.id;
            }
        })
        .state('module/mandatory/id/:moduleId/course/:courseId', {
            url: "/module/mandatory/id/:moduleId/course/:courseId",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/module/mandatory/id/"+$stateParams.moduleId+"/course/"+$stateParams.courseId;
            }
        })
        .state('module/view/:moduleId', {
            url: "/module/view/:moduleId",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/module/view/id/"+$stateParams.moduleId;
            }
        })
        .state('module/edit/:moduleId', {
            url: "/module/edit/:moduleId",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/module/update?id="+$stateParams.moduleId;
            }
        })
        .state('module/addAuchtor/:moduleId', {
            url: "/module/addAuchtor/:moduleId",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/module/addTeacher/id/"+$stateParams.moduleId;
            }
        })
        .state('module/addConsultant/:moduleId', {
            url: "/module/addConsultant/:moduleId",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/module/addConsultant/id/"+$stateParams.moduleId;
            }
        })
        .state('module/create', {
            url: "/module/create",
            cache: false,
            templateUrl:basePath+'/_teacher/_admin/module/create'
        })
});


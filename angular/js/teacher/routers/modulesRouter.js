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
            templateUrl: "/_teacher/_admin/module/index",
        })
        .state('module/addTeacher/id/:id', {
            url: "/module/addTeacher/id/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return "/_teacher/_admin/module/addTeacher/id/"+$stateParams.id;
            }
        })
        .state('module/coursePrice/id/:moduleId/course/:courseId', {
            url: "/module/coursePrice/id/:moduleId/course/:courseId",
            cache: false,
            templateUrl: function ($stateParams) {
                return "/_teacher/_admin/module/coursePrice/id/"+$stateParams.moduleId+"/course/"+$stateParams.courseId;
            }
        })
        .state('module/mandatory/id/:moduleId/course/:courseId', {
            url: "/module/mandatory/id/:moduleId/course/:courseId",
            cache: false,
            templateUrl: function ($stateParams) {
                return "/_teacher/_admin/module/mandatory/id/"+$stateParams.moduleId+"/course/"+$stateParams.courseId;
            }
        })
        .state('module/view/:moduleId', {
            url: "/module/view/:moduleId",
            cache: false,
            templateUrl: function ($stateParams) {
                return "/_teacher/_admin/module/view/id/"+$stateParams.moduleId;
            }
        })
});
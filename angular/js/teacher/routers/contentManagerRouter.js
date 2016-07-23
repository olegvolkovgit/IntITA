/**
 * Created by adm on 19.07.2016.
 */
var contentManagerUrl = "/_teacher/_content_manager/contentManager";

angular
    .module('contentManagerRouter',['ui.router']).
config(function ($stateProvider, $urlRouterProvider) {
    $stateProvider
        .state('content_manager', {
        url: "/content_manager",
        cache         : false,
        templateUrl: "/_teacher/cabinet/loadPage/?page=content_manager",
        })
        .state('content_manager/authors', {
            url: "/content_manager/authors",
            cache         : false,
            templateUrl: contentManagerUrl+"/authors",
        })
        .state('content_manager/consultants', {
            url: "/content_manager/consultants",
            cache         : false,
            templateUrl: contentManagerUrl+"/consultants",
        })
        .state('content_manager/teacherConsultants', {
            url: "/content_manager/teacherConsultants",
            cache         : false,
            templateUrl: contentManagerUrl+"/teacherConsultants",
        })
        .state('content_manager/revisions', {
            url: "/content_manager/revisions",
            cache         : false,
            templateUrl: "/revision/index",
        })
        .state('content_manager/statusOfModules/:idModule', {
            url: "/content_manager/statusOfModules/:idModule",
            cache         : false,
            templateUrl: function($stateParams){
                if ($stateParams.idModule == "all")
                    $stateParams.idModule =0;

                    return contentManagerUrl+"/statusOfModules/id/"+$stateParams.idModule;}
        })
        .state('content_manager/statusOfCourses', {
            url: "/content_manager/statusOfCourses",
            cache         : false,
            templateUrl: contentManagerUrl+"/statusOfCourses",
        })
        .state('/detail/module/:idModule', {
            url: '/detail/module/:idModule',
            templateUrl: function($stateParams){return "/_teacher/_content_manager/contentManager/showLessonsList?idModule="+$stateParams.idModule;},
        })
        .state('/detail/lesson/:idLesson', {
            url: '/detail/lesson/:idLesson',
            templateUrl: function($stateParams){return contentManagerUrl+"/showPartsList?idLesson="+$stateParams.idLesson;},
        })
});
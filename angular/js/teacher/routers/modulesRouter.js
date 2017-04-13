/**
 * Created by adm on 08.08.2016.
 */
angular
    .module('modulesRouter',['ui.router']).
config(function ($stateProvider) {
    $stateProvider
        .state('module/mandatory/id/:moduleId/course/:courseId', {
            url: "/module/mandatory/id/:moduleId/course/:courseId",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/moduleManage/mandatory/id/"+$stateParams.moduleId+"/course/"+$stateParams.courseId;
            }
        })
        .state('module/create', {
            url: "/module/create",
            cache: false,
            templateUrl:basePath+'/_teacher/moduleManage/create'
        })
        .state('module/edit/:moduleId', {
            url: "/module/edit/:moduleId",
            cache: false,
            controller: function($templateCache, $stateParams){
              $templateCache.remove(basePath+"/_teacher/moduleManage/view/id/"+$stateParams.moduleId);
            },
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/moduleManage/update?id="+$stateParams.moduleId;
            }
        })
        .state('module/addAuthor/:moduleId', {
            url: "/module/addAuthor/:moduleId",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/moduleManage/addAuthor/id/"+$stateParams.moduleId;
            }
        })
        .state('module/addTeacherConsultant/:moduleId', {
            url: "/module/addTeacherConsultant/:moduleId",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/moduleManage/addTeacherConsultant/id/"+$stateParams.moduleId;
            }
        })
});


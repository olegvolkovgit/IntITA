/**
 * Created by adm on 19.07.2016.
 */
var contentManagerUrl = basePath+"/_teacher/_content_manager/contentManager";

angular
    .module('contentManagerRouter',['ui.router']).
config(function ($stateProvider) {
    $stateProvider
        .state('content_manager', {
        url: "/content_manager",
        cache         : false,
        controller: function($scope){
            $scope.changePageHeader('Контент менеджер');
        },
        templateUrl: basePath+"/_teacher/cabinet/loadPage/?page=content_manager",
        })
        .state('content_manager/revisions', {
            url: "/content_manager/revisions",
            cache         : false,
            templateUrl: basePath+"/revision/index",
        })
        .state('content_manager/statusOfModules/:idModule', {
            controller: function($scope){
                $scope.changePageHeader('Стан модулів');
            },
            url: "/content_manager/statusOfModules/:courseId",
            cache         : false,
            templateUrl: function($stateParams){
                if ($stateParams.courseId == "all")
                    $stateParams.courseId =0;
                    return contentManagerUrl+"/statusOfModules/id/"+$stateParams.courseId;}
        })
        .state('content_manager/statusOfCourses', {
            url: "/content_manager/statusOfCourses",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Стан курсів');
            },
            templateUrl: contentManagerUrl+"/statusOfCourses",
        })
        .state('/detail/module/:idModule', {
            url: '/detail/module/:idModule',
            templateUrl: function($stateParams){return basePath+"/_teacher/_content_manager/contentManager/showLessonsList?idModule="+$stateParams.idModule;},
        })
        .state('/detail/course/:idCourse', {
            url: '/detail/course/:idCourse',
            templateUrl: function($stateParams){return basePath+"/_teacher/_content_manager/contentManager/getModulesList?idCourse="+$stateParams.idCourse;},
        })
        .state('/detail/lesson/:idLesson', {
            url: '/detail/lesson/:idLesson',
            templateUrl: function($stateParams){return contentManagerUrl+"/showPartsList?idLesson="+$stateParams.idLesson;},
        })
        .state('content_manager/authorAttributes', {
            url: "/content_manager/authorAttributes",
            cache: false,
            templateUrl: basePath+"/_teacher/_content_manager/roleAttributes/authorAttributes",
        })
        .state('content_manager/teacherConsultantAttributes', {
            url: "/content_manager/teacherConsultantAttributes",
            cache: false,
            templateUrl: basePath+"/_teacher/_content_manager/roleAttributes/teacherConsultantAttributes",
        })
        .state('content_manager/sendCoworkerRequest', {
            url: "/content_manager/sendCoworkerRequest",
            cache         : false,
            controller:'sendCoworkerRequestCtrl',
            templateUrl: contentManagerUrl+"/sendCoworkerRequest",
        })
        .state('content_manager/user/:id/role/:role', {
            url: "/content_manager/user/:id/role/:role",
            cache         : false,
            templateUrl: function($stateParams){
                return contentManagerUrl+"/userAttributesList/id/"+$stateParams.id+"/role/"+$stateParams.role;
            }
        })
        .state('lectures/verifycontent', {
            url: "/lectures/verifycontent",
            cache: false,
            templateUrl: basePath+"/_teacher/_content_manager/verifyContent/index",
        })
        .state('teacher/:id/editRole/role/:role', {
            url: "/teacher/:id/editRole/role/:role",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_content_manager/roleAttributes/editRole/id/"+$stateParams.id+'/role/'+$stateParams.role;
            }
        })
        .state('courses/addcourse', {
            url: "/courses/addcourse",
            cache: false,
            templateUrl: basePath+"/_teacher/courseManage/create",
        })
        .state('course/edit/:id', {
            url: "/course/edit/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/courseManage/update/id/"+$stateParams.id;
            }
        })
        .state('course/edit/:id/tab/:tab', {
            url: "/course/edit/:id/tab/:tab",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/courseManage/update/id/"+$stateParams.id;
            }
        })
});
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
        .state('content_manager/authors', {
            url: "/content_manager/authors",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Автори модулів');
            },
            templateUrl: contentManagerUrl+"/authors",
        })
        .state('content_manager/teacherConsultants', {
            url: "/content_manager/teacherConsultants",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Викладачі');
            },
            templateUrl: contentManagerUrl+"/teacherConsultants",
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
            controller: function($scope){
                $scope.changePageHeader('Атрибути автора контента');
            },
            templateUrl: basePath+"/_teacher/_content_manager/roleAttributes/authorAttributes",
        })
        .state('content_manager/teacherConsultantAttributes', {
            url: "/content_manager/teacherConsultantAttributes",
            cache: false,
            controller: function($scope){
                $scope.changePageHeader('Атрибути викладача');
            },
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
        .state('content_manager/verifycontent', {
            url: "/content_manager/verifycontent",
            cache: false,
            templateUrl: basePath+"/_teacher/_content_manager/verifyContent/index",
        })
});
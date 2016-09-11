/**
 * Created by adm on 19.07.2016.
 */
var contentManagerUrl = basePath+"/_teacher/_content_manager/contentManager";

angular
    .module('contentManagerRouter',['ui.router']).
config(function ($stateProvider, $urlRouterProvider) {
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
        .state('content_manager/consultants', {
            url: "/content_manager/consultants",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Консультанти');
            },
            templateUrl: contentManagerUrl+"/consultants",
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
        .state('content_manager/showUser/:id', {
            url: "/content_manager/showUser/:id",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Викладач');
            },
            templateUrl: function($stateParams){
                return contentManagerUrl+"/showTeacher/id/"+$stateParams.id},
        })
        .state('content_manager/addConsultantModule', {
            url: "/content_manager/addConsultantModule",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Призначити модуль для консультанта');
            },
            templateUrl: contentManagerUrl+"/addConsultantModuleForm",
        })
        .state('content_manager/addTeacherConsultantModule', {
            url: "/content_manager/addTeacherConsultantModule",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Призначити модуль для викладача');
            },
            templateUrl: contentManagerUrl+"/addTeacherConsultantForm",
        })
        .state('content_manager/addModuleAuthor', {
            url: "/content_manager/addModuleAuthor",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Призначити автора модуля');
            },
            templateUrl: contentManagerUrl+"/addTeacherModuleForm",
        })
});
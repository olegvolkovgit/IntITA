/**
 * Created by adm on 26.07.2016.
 */
angular
    .module('teacherConsultantRouter',['ui.router']).
config(function ($stateProvider, $urlRouterProvider, $locationProvider) {
    $stateProvider
        .state('teacherConsultant', {
            url: "/teacherConsultant",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Викладач');
            },
            templateUrl: basePath+"/_teacher/cabinet/loadPage/?page=teacher_consultant",
        })
        .state('teacherConsultant/modules', {
            url: "/teacherConsultant/modules",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Модулі');
            },
            templateUrl: basePath+"/_teacher/_teacher_consultant/teacherConsultant/modules/id/"+user,
        })
        .state('teacherConsultant/students', {
            url: "/teacherConsultant/students",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Студенти');
            },
            templateUrl: basePath+"/_teacher/_teacher_consultant/teacherConsultant/students/id/"+user,
        })
        .state('teacherConsultant/tasks', {
            url: "/teacherConsultant/tasks",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Всі задачі');
            },
            templateUrl: basePath+"/_teacher/_teacher_consultant/teacherConsultant/showTeacherPlainTaskList/idTeacher/"+user,
        })
        .state('teacherConsultant/task/:taskId', {
            url: "/teacherConsultant/task/:taskId",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Відповідь на задачу');
            },
            templateUrl: function($stateParams){
                return basePath+"/_teacher/_teacher_consultant/teacherConsultant/showPlainTask/idPlainTask/"+$stateParams.taskId
            }

        })

});



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
            templateUrl: basePath+"/_teacher/cabinet/loadPage/?page=teacher_consultant",
        })
        .state('teacherConsultant/modules', {
            url: "/teacherConsultant/modules",
            cache         : false,
            templateUrl: basePath+"/_teacher/_teacher_consultant/teacherConsultant/modules/id/"+user,
        })
        .state('teacherConsultant/students', {
            url: "/teacherConsultant/students",
            cache         : false,
            templateUrl: basePath+"/_teacher/_teacher_consultant/teacherConsultant/students/id/"+user,
        })
        .state('teacherConsultant/tasks', {
            url: "/teacherConsultant/tasks",
            cache         : false,
            templateUrl: basePath+"/_teacher/_teacher_consultant/teacherConsultant/showTeacherPlainTaskList/idTeacher/"+user,
        })
});

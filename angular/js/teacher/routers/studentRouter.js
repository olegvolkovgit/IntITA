/**
 * Created by adm on 26.07.2016.
 */
angular
    .module('studentRouter',['ui.router']).
config(function ($stateProvider, $urlRouterProvider, $locationProvider) {
    $stateProvider
        .state('students', {
            url: "/students",
            cache         : false,
            templateUrl: "/_teacher/cabinet/loadPage/?page=student",
        })
        .state('students/courses', {
            url: "/students/courses",
            cache         : false,
            templateUrl: "/_teacher/_student/student/index/id/"+user,
        })
        .state('students/consultations', {
            url: "/students/consultations",
            cache         : false,
            templateUrl: "/_teacher/_student/student/consultations/id/"+user,
        })

        .state('student/finances', {
            url: "/students/finances",
            cache         : false,
            templateUrl: "/_teacher/_student/student/finances/id/"+user,
        })
});

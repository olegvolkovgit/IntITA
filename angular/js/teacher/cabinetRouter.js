/**
 * Created by adm on 15.07.2016.
 */
var user = "";

angular
    .module('cabinetRouter',['ui.router']).
config(function ($stateProvider, $urlRouterProvider) {
        $stateProvider
            .state('messages', {
                url: "/messages",
                cache         : false,
                templateUrl: "/_teacher/messages/index"
            })
            .state('index', {
                url: "/index",
                cache         : false,
                templateUrl: "/_teacher/cabinet/loadDashboard/?user="+user,
            })
            .state('author', {
                url: "/author",
                cache         : false,
                templateUrl: "/_teacher/cabinet/loadPage/?page=author",
            })
            .state('author/modules', {
                url: "/author/modules",
                cache         : false,
                templateUrl: "/_teacher/_author/author/modules/id/"+user,
            })
            .state('consultant', {
                url: "/consultant",
                cache         : false,
                templateUrl: "/_teacher/cabinet/loadPage/?page=consultant",
            })
            .state('consultant/modules', {
                url: "/consultant/modules",
                cache         : false,
                templateUrl: "/_teacher/_consultant/consultant/modules/id/"+user,
            })
            .state('consultant/consultations', {
                url: "/consultant/consultations",
                cache         : false,
                templateUrl: "/_teacher/_consultant/consultant/consultations/id/"+user,
            })

            .state('teacherConsultant', {
                url: "/teacherConsultant",
                cache         : false,
                templateUrl: "/_teacher/cabinet/loadPage/?page=teacher_consultant",
            })
            .state('teacherConsultant/modules', {
                url: "/teacherConsultant/modules",
                cache         : false,
                templateUrl: "/_teacher/_teacher_consultant/teacherConsultant/modules/id/"+user,
            })
            .state('teacherConsultant/students', {
                url: "/teacherConsultant/students",
                cache         : false,
                templateUrl: "/_teacher/_teacher_consultant/teacherConsultant/students/id/"+user,
            })
            .state('teacherConsultant/tasks', {
                url: "/teacherConsultant/tasks",
                cache         : false,
                templateUrl: "/_teacher/_teacher_consultant/teacherConsultant/showTeacherPlainTaskList/idTeacher/"+user,
            })
            .state('trainer', {
                url: "/trainer",
                cache         : false,
                templateUrl: "/_teacher/cabinet/loadPage/?page=trainer",
            })
            .state('trainer/students', {
                url: "/trainer/students",
                cache         : false,
                templateUrl: "/_teacher/_trainer/trainer/students/id/"+user,
            })
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
            .state('tenant', {
                url: "/tenant",
                cache         : false,
                templateUrl: "/_teacher/cabinet/loadPage/?page=tenant",
            })
            .state('tenant/bots', {
                url: "/tenant/bots",
                cache         : false,
                templateUrl: "/_teacher/_tenant/tenant/Bots",
            })
            .state('tenant/chats', {
                url: "/tenant/chats",
                cache         : false,
                templateUrl: "/_teacher/_tenant/tenant/SearchChats",
            })
            .state('tenant/phrases', {
                url: "/tenant/phrases",
                cache         : false,
                templateUrl: "/_teacher/_tenant/tenant/showPhrases",
            })
}
);


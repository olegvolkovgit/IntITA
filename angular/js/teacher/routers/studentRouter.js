/**
 * Created by adm on 26.07.2016.
 */
angular
    .module('studentRouter',['ui.router']).
config(function ($stateProvider) {
    $stateProvider
        .state('student', {
            url: "/student",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Студент');
            },
            templateUrl: basePath+"/_teacher/cabinet/loadPage/?page=student",
        })
        .state('student/courses', {
            url: "/student/courses",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Доступні курси/модулі');
            },
            templateUrl: basePath+"/_teacher/_student/student/index/id/"+user,
        })
        .state('student/consultations', {
            url: "/student/consultations",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Консультації');
            },
            templateUrl: basePath+"/_teacher/_student/student/consultations/id/"+user,
        })
        .state('student/finances', {
            url: "/student/finances",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Фінанси');
            },
            templateUrl: basePath+"/_teacher/_student/student/finances/id/"+user,
        })
        .state('student/viewConsultation/:consultationId', {
            url: "/student/viewConsultation/:consultationId",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Консультація');
            },
            templateUrl: function($stateParams){
                return basePath+"/_teacher/_student/student/consultation/id/"+$stateParams.consultationId;
            }
        })
        .state('student/agreement/:agreementId', {
            url: "/student/agreement/:agreementId",
            cache         : false,
            templateUrl: function($stateParams){
                return basePath+"/_teacher/_student/student/agreement/id/"+$stateParams.agreementId;
            }
        })
        .state('student/offlineEducation', {
            url: "/student/offlineEducation",
            cache         : false,
            controller: 'offlineEducationCtrl',
            templateUrl: basePath+"/_teacher/_student/student/offlineEducation"
        })
        .state('student/plainTasks', {
            url: "/student/plainTasks",
            cache         : false,
            templateUrl: basePath+"/_teacher/_student/student/plainTasks",
        })
        .state('student/plainTask/:id', {
            url: "/student/plainTask/:id",
            cache         : false,
            templateUrl: function($stateParams){
                return basePath+"/_teacher/_student/student/plainTask/id/"+$stateParams.id;
            }
        })
        .state('student/contacts', {
            url: "/student/contacts",
            cache         : false,
            templateUrl: basePath+"/_teacher/_student/student/contacts",
        })
});


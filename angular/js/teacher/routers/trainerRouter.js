/**
 * Created by adm on 26.07.2016.
 */
angular
    .module('trainerRouter', ['ui.router']).
config(function ($stateProvider, $urlRouterProvider, $locationProvider) {
    $stateProvider
        .state('trainer', {
            url: "/trainer",
            cache: false,
            controller: function ($scope) {
                $scope.changePageHeader('Тренер');
            },
            templateUrl: basePath + "/_teacher/cabinet/loadPage/?page=trainer",
        })
        .state('trainer/students', {
            url: "/trainer/students",
            cache: false,
            controller: function ($scope) {
                $scope.changePageHeader('Студенти');
            },
            templateUrl: basePath + "/_teacher/_trainer/trainer/students/id/" + user,
        })
        .state('trainer/newstudents', {
            url: "/trainer/newstudents",
            cache: false,
            controller: function ($scope) {
                $scope.changePageHeader('Нові студенти');
            },
            templateUrl: basePath + "/_teacher/_trainer/trainer/students/id/" + user + "/filter/new/"
        })
        .state('trainer/viewStudent/:studentId', {
            url: "/trainer/viewStudent/:studentId",
            cache: false,
            controller: function ($scope) {
                $scope.changePageHeader('Нові студенти');
            },
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_trainer/trainer/viewStudent/id/" + $stateParams.studentId;
            }
        })
        .state('trainer/changeTeacher/modude/:idModule/student/:studentId', {
            url: "/trainer/changeTeacher/modude/:idModule/student/:studentId",
            cache: false,
            controller: function ($scope) {
                $scope.changePageHeader('Нові студенти');
            },
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_trainer/trainer/editTeacherModule/id/"+$stateParams.studentId+"/idModule/" + $stateParams.idModule;
            }
        })
        .state('trainer/addConsultantModule/:idModule', {
            url: "/trainer/addConsultantModule/:idModule",
            cache: false,
            controller: function ($scope) {
                $scope.changePageHeader('Призначити модуль консультанту');
            },
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_admin/module/addTeacherConsultant/idModule/" + $stateParams.idModule;
            }
        })

});
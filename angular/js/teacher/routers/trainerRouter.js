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
            templateUrl: basePath + "/_teacher/_trainer/trainer/students",
        })
        .state('trainer/viewStudent/:studentId', {
            url: "/trainer/viewStudent/:studentId",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_trainer/trainer/viewStudent/id/" + $stateParams.studentId;
            }
        })
        .state('trainer/changeTeacher/modude/:idModule/student/:studentId', {
            url: "/trainer/changeTeacher/modude/:idModule/student/:studentId",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_trainer/trainer/editTeacherModule/id/"+$stateParams.studentId+"/idModule/" + $stateParams.idModule;
            }
        })
        .state('trainer/students/agreements', {
            url: "/trainer/students/agreements",
            cache         : false,
            templateUrl: basePath + "/_teacher/_trainer/trainer/renderTrainerUsersAgreements"
        })
});
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
            url: "/trainer",
            cache: false,
            templateUrl: basePath + "/_teacher/_trainer/trainer/students"
        })
        .state('trainer/students.trainerStudents', {
            url: '/trainerStudents',
            views: {
                'trainerTabs': {
                    templateUrl: basePath+"/_teacher/_trainer/trainer/attachStudents",
                }
            }
        })
        .state('trainer/students.personalInfo', {
            url: '/personalInfo',
            views: {
                'trainerTabs': {
                    templateUrl: basePath+"/_teacher/_trainer/trainer/personalInfo"
                }
            }
        })
        .state('trainer/students.career', {
            url: '/career',
            views: {
                'trainerTabs': {
                    templateUrl: basePath+"/_teacher/_trainer/trainer/careerInfo"
                }
            }
        })
        .state('trainer/students.contract', {
            url: '/contract',
            views: {
                'trainerTabs': {
                    templateUrl: basePath+"/_teacher/_trainer/trainer/contractInfo"
                }
            }
        })
        .state('trainer/students.visit', {
            url: '/visit',
            views: {
                'trainerTabs': {
                    templateUrl: basePath+"/_teacher/_trainer/trainer/visitInfo",
                }
            }
        })
        .state('trainer/students.studentsProjects', {
            url: '/studentsProjects',
            views: {
                'trainerTabs': {
                    templateUrl: basePath+"/_teacher/_trainer/trainer/studentsProjects",
                }
            }
        })
        .state('studentsProject', {
            url: "/studentsProject/:projectId",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_trainer/trainer/showFiles/projectId/" + $stateParams.projectId;
            }
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
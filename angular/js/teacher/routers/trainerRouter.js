/**
 * Created by adm on 26.07.2016.
 */
angular
    .module('trainerRouter',['ui.router']).
config(function ($stateProvider, $urlRouterProvider, $locationProvider) {
    $stateProvider
        .state('trainer', {
            url: "/trainer",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Тренер');
            },
            templateUrl: basePath+"/_teacher/cabinet/loadPage/?page=trainer",
        })
        .state('trainer/students', {
            url: "/trainer/students",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Студенти');
            },
            templateUrl: basePath+"/_teacher/_trainer/trainer/students/id/"+user,
        })
        .state('trainer/newstudents', {
            url: "/trainer/newstudents",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Нові студенти');
            },
            templateUrl: basePath+"/_teacher/_trainer/trainer/students/id/"+user+"/filter/new/"
        })

});

/**
 * Created by adm on 26.07.2016.
 */
angular
    .module('schedulerTasks',['ui.router']).
config(function ($stateProvider, $urlRouterProvider, $locationProvider) {
    $stateProvider
        .state('scheduler/tasks', {
            url: "/scheduler/tasks",
            cache         : false,
            templateUrl: basePath+"/_teacher/schedulerTasks/index",
            controller: function($scope){
                $scope.changePageHeader('Заплановані завдання ');
            }
        })
        .state('scheduler/task/:id', {
            url: "/scheduler/task/:id",
            cache         : false,
            templateUrl: function($stateParams){
                return basePath+"/_teacher/schedulerTasks/view/id/"+$stateParams.id
            },
            controller: function($scope){
                $scope.changePageHeader('Перегляд завдання ');
            }
        })
        .state('scheduler/task/edit/:id', {
            url: "/scheduler/task/edit/:id",
            cache         : false,
            templateUrl: function($stateParams){
                return basePath+"/_teacher/schedulerTasks/edit/id/"+$stateParams.id
            },
            controller: function($scope){
                $scope.changePageHeader('Редагувати лист ');
            }
        })
});

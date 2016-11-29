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
});

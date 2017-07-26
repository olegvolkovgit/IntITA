/**
 * Created by adm on 16.07.2016.
 */
angular
    .module('crmRouter',['ui.router'])
    .config(function ($stateProvider) {
        $stateProvider
            .state('tasks', {
                url: "/tasks",
                cache: false,
                templateUrl: basePath+"/_teacher/crm/_tasks/tasks/index",
            })
            .state('tasks.my', {
                url: '/my',
                views: {
                    'usersTasks': {
                        templateUrl: basePath+"/_teacher/crm/_tasks/tasks/myTasks",
                    }
                }
            })
            .state('tasks.helps', {
                url: '/helps',
                views: {
                    'usersTasks': {
                        templateUrl: basePath+"/_teacher/crm/_tasks/tasks/helpsTasks",
                    }
                }
            })
            .state('tasks.entrust', {
                url: '/entrust',
                views: {
                    'usersTasks': {
                        templateUrl: basePath+"/_teacher/crm/_tasks/tasks/entrustTasks",
                    }
                }
            })
            .state('tasks.watch', {
                url: '/watch',
                views: {
                    'usersTasks': {
                        templateUrl: basePath+"/_teacher/crm/_tasks/tasks/watchTasks",
                    }
                }
            })
    });
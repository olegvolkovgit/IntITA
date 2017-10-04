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
            .state('tasks.executant', {
                url: '/executant',
                views: {
                    'usersTasks': {
                        templateUrl: basePath+"/_teacher/crm/_tasks/tasks/myTasks",
                    }
                }
            })
            .state('tasks.collaborator', {
                url: '/collaborator',
                views: {
                    'usersTasks': {
                        templateUrl: basePath+"/_teacher/crm/_tasks/tasks/helpsTasks",
                    }
                }
            })
            .state('tasks.producer', {
                url: '/producer',
                views: {
                    'usersTasks': {
                        templateUrl: basePath+"/_teacher/crm/_tasks/tasks/entrustTasks",
                    }
                }
            })
            .state('tasks.observer', {
                url: '/observer',
                views: {
                    'usersTasks': {
                        templateUrl: basePath+"/_teacher/crm/_tasks/tasks/watchTasks",
                    }
                }
            })
            .state('tasks.all', {
                url: '/all',
                views: {
                    'usersTasks': {
                        templateUrl: basePath+"/_teacher/crm/_tasks/tasks/allTasks",
                    }
                }
            })
            .state('tasksManager', {
                url: '/tasksManager',
                templateUrl: basePath+"/_teacher/crm/_tasks/tasks/manager",
            })
    });
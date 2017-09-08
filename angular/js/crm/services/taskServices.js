'use strict';

/* Services */

angular
    .module('crmApp')
    .factory('crmTaskServices', ['$resource','transformRequest',
        function ($resource, transformRequest) {
            var url = basePath + '/_teacher/crm/_tasks/tasks';
            return $resource(
                '',
                {},
                {
                    getCrmRoles: {
                        url: url + '/getRoles',
                        method: 'GET',
                        isArray:true,
                    },
                    getUsersByCategory: {
                        url: url + '/getUsers',
                        method: 'GET',
                        isArray:true,
                    },
                    sendCrmTask : {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/sendTask',
                        transformRequest : transformRequest.bind(null)
                    },
                    getTasks: {
                        url: url + '/getTasks',
                        method: 'GET',
                    },
                    getCrmTask: {
                        url: url + '/getCrmTask',
                        method: 'GET',
                        transformRequest : transformRequest.bind(null)
                    },
                    changeTaskState: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/changeTaskState',
                        transformRequest : transformRequest.bind(null)
                    },
                    getTasksHistory: {
                        url: url + '/getTasksHistory',
                        method: 'GET',
                    },
                    getTaskComments: {
                        url: url + '/getTaskComments',
                        method: 'GET',
                    },
                    addCrmTaskComment : {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/addTaskComment',
                        transformRequest : transformRequest.bind(null)
                    },
                    removeCrmTaskComment : {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/removeTaskComment',
                        transformRequest : transformRequest.bind(null)
                    },
                    editCrmTaskComment : {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/editTaskComment',
                        transformRequest : transformRequest.bind(null)
                    },
                    crmStateList: {
                        url: url + '/getCrmStatesList',
                        method: 'GET',
                        isArray:true,
                    },
                    activeCrmTasksCount: {
                        url: url + '/getActiveCrmTasksCount',
                        method: 'GET',
                        isArray:true,
                    },
                    cancelCrmTask: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/cancelCrmTask',
                        transformRequest : transformRequest.bind(null)
                    },
                    getTaskSpentTime: {
                        url: url + '/getTaskSpentTime',
                        method: 'GET',
                    },
                    getSpentTimeTask: {
                        url: url + '/getSpentTimeTask',
                        method: 'GET',
                    },
                });
        }]);
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
                    getSubTasks: {
                        url: url + '/getSubTasks',
                        method: 'GET',
                        isArray:true,
                    },
                    sendCrmTask : {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/sendTask',
                        transformRequest : transformRequest.bind(null)
                    },
                    updateCrmBody : {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/updateBody',
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
                    getCrmSubTasks: {
                        url: url + '/getCrmSubTasks',
                        method: 'GET',
                        isArray:true,
                    },
                    getTimeList: {
                        url: url + '/getTimeList',
                        method: 'GET',
                        isArray:true,
                    },
                    getCheckList: {
                        url: url + '/getCheckList',
                        method: 'GET',
                    },
                    createCrmCheckList: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/createCrmCheckList',
                        transformRequest : transformRequest.bind(null)
                    },
                    removeCrmCheckList: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/removeCrmCheckList',
                        transformRequest : transformRequest.bind(null)
                    },
                    createCrmCheckListElement: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/createCrmCheckListElement',
                        transformRequest : transformRequest.bind(null)
                    },
                    updateCrmCheckListElement: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/updateCheckListElement',
                        transformRequest : transformRequest.bind(null)
                    },
                    changeCrmCheckListElementStatus: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/changeCheckListElementStatus',
                        transformRequest : transformRequest.bind(null)
                    },
                    deleteCrmCheckListElement: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/deleteCheckListElement',
                        transformRequest : transformRequest.bind(null)
                    },
                    // updateSubTasks: {
                    //     method: 'POST',
                    //     headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                    //     url: url + '/updateSubTasks',
                    //     transformRequest : transformRequest.bind(null)
                    // },
                    addSubTask: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/addSubTask',
                        transformRequest : transformRequest.bind(null)
                    },
                    removeSubTask: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/removeSubTask',
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
                    tasksManagerList: {
                        url: url + '/tasksManagerList',
                        method: 'GET',
                        isArray:true,
                    },
                    visitedTasksManager: {
                        url: url + '/visitedTasksManager',
                        method: 'GET',
                        isArray:true,
                    },
                    getNotificationTemplates: {
                        url: basePath + '/_teacher/mailTemplates/getMailTemplatesList?type=2',
                        method: 'GET',
                        isArray:true,
                    },
                    getCreatedEvents: {
                        url: url + '/getCreatedEvents',
                        method: 'GET',
                    },
                });
        }]);
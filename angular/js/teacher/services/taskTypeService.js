'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('taskTypeService', ['$resource','transformRequest',
        function ($resource, transformRequest) {
            var url=basePath+'/_teacher/_super_admin/config';
            return $resource(
                '',
                {},
                {
                    crmTasksTypeList: {
                        url: basePath + '/_teacher/crm/_tasks/tasks/getCrmTasksTypeList',
                        method: 'GET',
                        isArray:true,
                    },
                    createTaskType : {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/createTaskType',
                        transformRequest : transformRequest.bind(null)
                    },
                    crmTaskType : {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/getTaskTypeData',
                        transformRequest : transformRequest.bind(null)
                    },
                    updateTaskType : {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/updateTaskType',
                        transformRequest : transformRequest.bind(null)
                    },
                    reorderTaskType : {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/reorderTaskType',
                        transformRequest : transformRequest.bind(null)
                    },
                });
        }]);
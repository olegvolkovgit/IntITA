'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('teacherConsultantService', ['$resource','transformRequest',
        function ($resource,transformRequest) {
            var url = basePath+'/_teacher/_teacher_consultant/teacherConsultant';
            return $resource(
                '',
                {},
                {
                    plainTasksList: {
                        url: url + '/plainTaskListByTeacher',
                        method: 'GET',
                    },
                    setMarkPlainTask : {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/markPlainTask',
                        transformRequest : transformRequest.bind(null)
                    },
                    studentsCategoryList: {
                        url: url + '/getStudentsCategoryList',
                        method: 'GET',
                        isArray:true,
                    },
                    teacherConsultantsGroupList: {
                        url: url + '/getTeacherConsultantsGroupList',
                        method: 'GET',
                        isArray:true,
                    },
                    studentsModulesByGroup: {
                        url: url + '/getStudentsModulesByGroup',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        method: 'POST',
                        transformRequest : transformRequest.bind(null),
                        isArray:true,
                    },
                    studentsModulesWithoutGroup: {
                        url: url + '/getStudentsModulesWithoutGroup',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        method: 'POST',
                        isArray:true,
                    },
                });
        }]);
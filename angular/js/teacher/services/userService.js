'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('userService', ['$resource',
        function ($resource) {
            var url = basePath+'/studentreg';
            return $resource(
                '',
                {},
                {
                    typeahead: {
                        url: url + '/getTypeahead',
                        params: {
                            query : 'query'
                        },
                        isArray:true
                    },
                    query: {
                        url : url + '/getUser',
                        isArray:true
                    },
                    userProfileData: {
                        url : basePath+'/_teacher/user/loadJsonUserProfile',
                        params: {
                            userId : 'userId'
                        },
                    },
                    userOfflineEducationData: {
                        url : basePath+'/_teacher/user/loadJsonUserOfflineEducation',
                        params: {
                            userId : 'userId'
                        },
                    },
                    teacherProfileData: {
                        url : basePath+'/_teacher/user/loadJsonTeacherProfile',
                        params: {
                            userId : 'userId'
                        },
                    },
                    userRoleData: {
                        url : basePath+'/_teacher/user/loadJsonUserRoles',
                        params: {
                            userId : 'userId'
                        },
                    },
                    rolesHistory: {
                        url : basePath+'/_teacher/user/getRolesHistory',
                        params: {
                            userId : 'userId'
                        },
                        isArray:true,
                    },
                    studentAttributes: {
                        url : basePath+'/_teacher/user/loadJsonStudentAttributes',
                        params: {
                            userId : 'userId'
                        },
                    },
                    userOrganizationTrainer: {
                        url : basePath+'/_teacher/user/loadUserOrganizationTrainer',
                        params: {
                            userId : 'userId'
                        },
                    },
                });
        }]);

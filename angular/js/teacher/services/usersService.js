'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('usersService', ['$resource',
        function ($resource) { 
            var url = basePath+'/_teacher/_admin/users';
            return $resource(
                '',
                {},
                {
                    usersList: {
                        url: url + '/getUsersList',
                        method: 'GET',
                    },
                    studentsList: {
                        url: url + '/getStudentsList',
                        method: 'GET',
                    },
                    teachersList: {
                        url: url + '/getTeachersList',
                        method: 'GET'
                    },
                    withoutRolesList: {
                        url: url + '/getWithoutRolesUsersList', 
                        method: 'GET'
                    },
                    adminsList: {
                        url: url + '/getAdminsList',
                            method: 'GET'
                    },
                    accountantsList: {
                        url: url + '/getAccountantsList',
                        method: 'GET'
                    },
                    contentManagersList: {
                        url: url + '/getContentManagersList',
                        method: 'GET'
                    },
                    teacherConsultantsList: {
                        url: url + '/getTeacherConsultantsList',
                        method: 'GET'
                    },
                    trainersList: {
                        url: url + '/getTrainersList',
                        method: 'GET'
                    },
                    consultantsList: {
                        url: url + '/getConsultantsList',
                        method: 'GET'
                    },
                    tenantsList: {
                        url: url + '/getTenantsList',
                        method: 'GET'
                    },
                    authorsList: {
                        url: basePath + '/_teacher/_content_manager/contentManager/getAuthorsList',
                        method: 'GET'
                    },
                    blockedUsersList: {
                        url: url + '/getBlockedUsersList',
                    },
                    superVisorsList: {
                        url: url + '/getSuperVisorsList',
                        method: 'GET'
                    },
                });
        }]);

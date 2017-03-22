'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('usersService', ['$resource',
        function ($resource) { 
            var url = basePath+'/_teacher/users';
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
                    offlineStudentsList: {
                        url: url + '/getOfflineStudentsList',
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
                    tenantsList: {
                        url: url + '/getTenantsList',
                        method: 'GET'
                    },
                    authorsList: {
                        url: url + '/getAuthorsList',
                        method: 'GET'
                    },
                    blockedUsersList: {
                        url: url + '/getBlockedUsersList',
                    },
                    superVisorsList: {
                        url: url + '/getSuperVisorsList',
                        method: 'GET'
                    },
                    usersEmailList: {
                        url: url + '/getUsersEmailList',
                        method: 'GET'
                    },
                    emailsCategoryList: {
                        url: url + '/getEmailsCategoryList',
                        method: 'GET',
                        isArray:true,
                    },
                    emailCategoryData: {
                        url: url + '/getEmailCategoryData',
                        method: 'GET',
                    },
                    usersCount: {
                        url: url + '/getUsersCount',
                        method: 'GET',
                        isArray:true,
                    },
                    directorsList: {
                        url: url + '/getDirectorsList',
                        method: 'GET'
                    },
                    auditorsList: {
                        url: url + '/getAuditorsList',
                        method: 'GET'
                    },
                    superAdminsList: {
                        url: url + '/getSuperAdminsList',
                        method: 'GET'
                    },
                });
        }]);

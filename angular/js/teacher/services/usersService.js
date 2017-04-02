'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('usersService', ['$resource','transformRequest',
        function ($resource, transformRequest) { 
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
                    organizationUsersCount: {
                        url: url + '/getOrganizationUsersCount',
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
                    updateTeacherProfile: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: basePath+'/_teacher/_admin/teachers/updateProfile',
                        transformRequest : transformRequest.bind(null)
                    },
                    teacherProfileData: {
                        method: 'GET',
                        url: basePath+'/_teacher/_admin/teachers/getTeacherProfile',
                    },
                    cancelTeacher: {
                        url: basePath+'/_teacher/_admin/teachers/cancelTeacher',
                        method: 'GET',
                    },
                });
        }]);

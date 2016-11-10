'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('superVisorService', ['$resource',
        function ($resource) { 
            var url = basePath+'/_teacher/_super_visor/superVisor';
            return $resource(
                '',
                {},
                {
                    offlineGroupsList: {
                        url: url + '/getOfflineGroupsList',
                        method: 'GET',
                    },
                    offlineSubgroupsList: {
                        url: url + '/getOfflineSubgroupsList',
                        method: 'GET',
                    },
                    offlineStudentsList: {
                        url: url + '/getOfflineStudentsList',
                        method: 'GET',
                    },
                    studentsWithoutGroupList: {
                        url: url + '/getStudentsWithoutGroupList',
                        method: 'GET',
                    },
                    offlineGroupSubgroupsList: {
                        url: url + '/getGroupsOfflineSubgroupsList',
                        method: 'GET',
                    },
                    getSpecializationsList: {
                        url: url + '/getSpecializationsList',
                        isArray:true
                    },
                    usersList: {
                        url: url + '/getUsersList',
                        method: 'GET',
                    },
                    studentsList: {
                        url: url + '/getStudentsList',
                        method: 'GET',
                    },
                });
        }]);
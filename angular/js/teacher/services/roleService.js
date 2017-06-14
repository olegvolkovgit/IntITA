'use strict';
angular
    .module('teacherApp')
    .factory('roleService', ['$resource',
        function ($resource) { 
            var localUrl = basePath+'/_teacher/_admin/role';
            var directorUrl = basePath+'/_teacher/_director/role';
            return $resource(
                '',
                {},
                {
                    assignLocalRole: {
                        url: localUrl + '/assignLocalRole',
                        method: 'GET',
                    },
                    cancelLocalRole: {
                        url: localUrl + '/cancelLocalRole',
                        method: 'GET',
                    },
                    assignRoleByDirector: {
                        url: directorUrl+'/assignRole',
                        method: 'GET',
                    },
                    cancelRoleByDirector: {
                        url: directorUrl+'/cancelRole',
                        method: 'GET',
                    },
                    localRolesList: {
                        url: localUrl + '/getLocalRolesList',
                        method: 'GET',
                        isArray: true,
                    },
                });
        }]);
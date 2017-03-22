'use strict';
angular
    .module('teacherApp')
    .factory('roleService', ['$resource',
        function ($resource) { 
            var localUrl = basePath+'/_teacher/_admin/role';
            var globalUrl = basePath+'/_teacher/_director/role';
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
                    assignGlobalRole: {
                        url: globalUrl + '/assignGlobalRole',
                        method: 'GET',
                    },
                    cancelGlobalRole: {
                        url: globalUrl + '/cancelGlobalRole',
                        method: 'GET',
                    },
                });
        }]);
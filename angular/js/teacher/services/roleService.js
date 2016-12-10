'use strict';
angular
    .module('teacherApp')
    .factory('roleService', ['$resource',
        function ($resource) { 
            var url = basePath+'/_teacher/_admin/users';
            return $resource(
                '',
                {},
                {
                    assignRole: {
                        url: url + '/assignRole',
                        method: 'GET',
                    },
                    cancelRole: {
                        url: url + '/cancelRole',
                        method: 'GET',
                    },
                });
        }]);
'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('roleAttributeService', ['$resource',
        function ($resource) { 
            var url = basePath+'/_teacher/_content_manager/contentManager';
            return $resource(
                '',
                {},
                {
                    setRoleAttribute: {
                        url: url + '/setTeacherRoleAttribute',
                        method: 'GET',
                    },
                    unsetRoleAttribute: {
                        url: url + '/unsetTeacherRoleAttribute',
                        method: 'GET',
                    },
                });
        }]);
'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('roleAttributeService', ['$resource',
        function ($resource) { 
            var url = basePath+'/_teacher/_content_manager/roleAttributes';
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
                    setTrainerRoleAttribute: {
                        url: basePath+'/_teacher/_supervisor/roleAttributes/setTeacherRoleAttribute',
                        method: 'GET',
                    },
                    unsetTrainerRoleAttribute: {
                        url: basePath+'/_teacher/_supervisor/roleAttributes/unsetTeacherRoleAttribute',
                        method: 'GET',
                    },
                });
        }]);
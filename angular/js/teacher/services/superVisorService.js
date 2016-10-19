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
                    getSpecializationsList: {
                        url: url + '/getSpecializationsList',
                        isArray:true
                    },
                });
        }]);
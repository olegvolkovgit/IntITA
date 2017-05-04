'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('responseService', ['$resource',
        function ($resource) { 
            var url = basePath+'/_teacher/_super_admin/response';
            return $resource(
                '',
                {},
                {
                    responsesList: {
                        url: url + '/getResponsesList',
                        method: 'GET',
                    },
                });
        }]);

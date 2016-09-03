'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('paymentSchemaService', ['$resource', 'transformRequest',
        function ($resource, transformRequest) {
            var url = basePath + '/_teacher/_accountant/paymentSchema';
            return $resource(
                '',
                {},
                {
                    query: {
                        url: url + '/getSchemas',
                        method: 'GET',
                        isArray : true
                    }
                });
        }]);

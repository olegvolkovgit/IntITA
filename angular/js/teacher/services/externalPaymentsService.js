'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('externalPaymentsService', ['$resource', 'transformRequest',
        function ($resource, transformRequest) {
            var url = basePath + '/_teacher/_accountant/externalPayments';
            return $resource(
                '',
                {},
                {
                    create: {
                        url: url + '/createPayment',
                        method: 'POST'
                    },
                    typeahead : {
                        url: url + '/getTypeahead',
                        method: 'GET',
                        isArray:true
                    },
                    getById : {
                        url : url + '/getPayment',
                        method: 'GET'
                    }
                }
            );
        }]);

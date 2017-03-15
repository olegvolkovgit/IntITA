'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('externalPaymentsService', ['$resource','transformRequest',
        function ($resource, transformRequest) {
            var url = basePath + '/_teacher/_accountant/externalPayments';
            return $resource(
                '',
                {},
                {
                    list: {
                        url: url + '/getNgTable'
                    },
                    create: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/createPayment',
                        transformRequest : transformRequest.bind(null)
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

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
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        transformRequest : function (data, headersGetter) {
                            return transformRequest(data);
                        }
                    },
                    typeahead : {
                        url: url + '/getTypeahead',
                        method: 'GET',
                        isArray:true
                    }
                }
            );
        }]);

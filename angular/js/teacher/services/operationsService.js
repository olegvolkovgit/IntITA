'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('operationsService', ['$resource', 'transformRequest',
        function ($resource, transformRequest) {
            var url = '/_teacher/_accountant/operation';
            return $resource(
                '',
                {},
                {
                    list: {
                        url: url + '/getOperations',
                        method: 'GET',
                        params: {
                            page: 'page',
                            pageCount: 'pageCount'
                        }
                    },
                        create: {
                        method:'POST',
                        url:url + '/createByInvoice',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        transformRequest : function (data, headersGetter) {
                            return transformRequest(data);
                        }
                    }
                });
        }]);

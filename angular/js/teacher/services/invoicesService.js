'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('invoices', ['$resource',
    function ($resource) {
        var url = '/_teacher/_accountant/invoices/getInvoices';
        return $resource(
            url,
            {
                page: 'page',
                limit: 'limit'
            },
            {
                list: {
                    method: 'GET',
                    params: {
                        page: 'page',
                        limit: 'limit'
                    }
                }
            });
    }]);

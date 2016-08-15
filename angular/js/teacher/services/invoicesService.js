'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('invoices', ['$resource',
    function ($resource) {
        var url = '/_teacher/_accountant/invoices';
        return $resource(
            url,
            {},
            {
                list: {
                    url : url + '/getInvoices',
                    method: 'GET',
                    params: {
                        page: 'page',
                        pageCount: 'pageCount'
                    }
                }
            });
    }]);

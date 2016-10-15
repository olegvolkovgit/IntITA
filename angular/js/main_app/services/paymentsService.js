'use strict';

/* Services */

angular
    .module('mainApp')
    .factory('paymentsService', ['$resource',
    function ($resource) {
        var url = basePath+'/course';
        return $resource(
            url,
            {},
            {
                scheme: {
                    url : url + '/getPaymentSchemas',
                }
            });
    }]);

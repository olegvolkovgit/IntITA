'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('internalPaymentsService', ['$resource',
        function ($resource) {
            var url = basePath + '/_teacher/_accountant/internalPayments';
            return $resource(
                '',
                {},
                {
                    list: {
                        url: url + '/getNgTable'
                    }
                }
            );
        }]);

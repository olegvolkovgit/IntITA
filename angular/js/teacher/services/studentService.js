'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('studentService', ['$resource',
        function ($resource) { 
            var url = basePath+'/_teacher/_student/student';
            return $resource(
                '',
                {},
                {
                    invoicesByAgreement: {
                        url: url + '/getInvoicesByAgreement',
                        method: 'GET',
                    },
                });
        }]);

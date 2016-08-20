'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('operationsService', ['$resource',
        function ($resource) {
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
                    }
                });
        }]);

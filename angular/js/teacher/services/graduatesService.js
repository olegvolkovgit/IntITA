'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('graduates', ['$resource',
    function ($resource) {
        var url = '/_teacher/_admin/graduate/getgraduatesjson';
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

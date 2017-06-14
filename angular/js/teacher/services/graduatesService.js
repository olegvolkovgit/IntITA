'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('graduates', ['$resource',
    function ($resource) {
        var url = basePath+'/_teacher/graduate/getGraduatesJson';
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

'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('interfaceMessages', ['$resource',
    function ($resource) {
        var url = '/_teacher/_admin/translate/gettranslateslist';
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

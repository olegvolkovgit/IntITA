'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('interfaceMessages', ['$resource',
    function ($resource) {
        var url = basePath+'/_teacher/_admin/translate/gettranslateslist';
        return $resource(
            url,
            {
            },
            {
                list: {
                    url: url,
                    method: 'GET'
                }
            });
    }]);

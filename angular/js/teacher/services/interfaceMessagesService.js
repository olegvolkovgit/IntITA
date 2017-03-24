'use strict';

angular
    .module('teacherApp')
    .factory('interfaceMessages', ['$resource',
    function ($resource) {
        var url=basePath+"/_teacher/_super_admin";
        return $resource(
            url,
            {
            },
            {
                list: {
                    url: url+'/translate/gettranslateslist',
                    method: 'GET'
                }
            });
    }]);

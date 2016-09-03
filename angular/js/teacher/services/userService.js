'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('userService', ['$resource',
        function ($resource) {
            var url = basePath+'/studentreg';
            return $resource(
                '',
                {},
                {
                    typeahead: {
                        url: url + '/getTypeahead',
                        params: {
                            query : 'query'
                        },
                        isArray:true
                    },
                    query: {
                        url : url + '/getUser',
                        isArray:true
                    }
                });
        }]);

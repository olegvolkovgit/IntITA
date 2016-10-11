'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('courseService', ['$resource',
        function ($resource) {
            var url = basePath+'/course';
            return $resource(
                '',
                {},
                {
                    typeahead: {
                        url: url + '/getTypeahead',
                        isArray:true
                    }
                });
        }]);

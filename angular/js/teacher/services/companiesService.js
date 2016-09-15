'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('companiesService', ['$resource',
        function ($resource) {
            var url = basePath+'/_teacher/_accountant/company';
            return $resource(
                '',
                {},
                {
                    list: {
                        url: url+'/list',
                        method:"GET"
                    }
                });
        }]);

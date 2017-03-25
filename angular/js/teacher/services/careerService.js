'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('careerService', ['$resource',
        function ($resource) { 
            var url = basePath+'/_teacher/_super_admin/config';
            return $resource(
                '',
                {},
                {
                    getCareersList: {
                        url: url + '/getCareersList',
                        isArray:true
                    },
                });
        }]);
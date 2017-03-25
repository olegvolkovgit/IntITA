'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('organizationService', ['$resource','transformRequest',
        function ($resource, transformRequest) { 
            var url = basePath+'/_teacher/_director/organization';
            return $resource(
                '',
                {},
                {
                    organizationsList: {
                        url: url + '/getOrganizationsList',
                        method: 'GET',
                    },
                    create: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/createOrganization',
                        transformRequest : transformRequest.bind(null)
                    },
                    update: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/updateOrganization',
                        transformRequest : transformRequest.bind(null)
                    },
                    organizationData: {
                        method: 'GET',
                        url: url + '/getOrganization',
                    },
                });
        }])
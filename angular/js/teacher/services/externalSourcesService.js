'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('externalSourcesService', ['$resource', 'transformRequest',
        function ($resource, transformRequest) {
            var url = basePath + '/_teacher/_accountant/externalSources';
            return $resource(
                '',
                {},
                {
                    list: {
                        url: url + '/getSources',
                        method: 'GET',
                        isArray: true
                    },
                    create: {
                        url: url + '/create',
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        transformRequest : function (data, headersGetter) {
                            return transformRequest(data);
                        }
                    },
                    getExternalSourcesList: {
                        url: url + '/getSourcesList',
                        method: 'GET',
                    },
                    externalSource: {
                        url: url + '/getExternalSource',
                        method: 'GET',
                    },
                }
            );
        }]);

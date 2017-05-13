'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('auditorService', ['$resource',
        function ($resource) {
            var url = basePath+'/_teacher/_auditor';
            return $resource(
                '',
                {},
                {
                    cancelReasonTypeList: {
                        url: url + '/cancelReasonType/getCancelReasonTypeList',
                        method: 'GET',
                    },

                });
        }]);
'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('teacherService', ['$resource',
        function ($resource) {
            var url = basePath+'/_teacher/_admin/teachers';
            return $resource(
                '',
                {},
                {
                    dataList: {
                        url: url + '/getTeacherDataList',
                        method: 'GET',
                    },
                });
        }]);


'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('studentProgressService', ['$resource','transformRequest',
        function ($resource, transformRequest) {
            var url = basePath+'/_teacher/studentProgress';
            return $resource(
                '',
                {},
                {
                    getLecturesRatings: {
                        url: url + '/getLectureRating',
                        isArray: true
                    },
                });
        }]);

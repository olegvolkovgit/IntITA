'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('trainerService', ['$resource',
        function ($resource) { 
            var url = basePath+'/_teacher/_trainer/trainer';
            return $resource(
                '',
                {},
                {
                    trainersStudentsList: {
                        url: url + '/getTrainersStudentsList',
                        method: 'GET',
                    },
                });
        }])
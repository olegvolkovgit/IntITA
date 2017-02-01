'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('teacherConsultantService', ['$resource',
        function ($resource) { 
            var url = basePath+'/_teacher/_teacher_consultant/teacherConsultant';
            return $resource(
                '',
                {},
                {
                    plainTasksList: {
                        url: url + '/plainTaskListByTeacher',
                        method: 'GET',
                    },
                });
        }]);
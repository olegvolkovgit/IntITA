'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('accountantService', ['$resource',
        function ($resource) { 
            var url = basePath+'/_teacher/_accountant/accountant';
            return $resource(
                '',
                {},
                {
                    documentsList: {
                        url: url + '/getDocumentsList',
                        method: 'GET',
                    },
                    
                });
        }]);
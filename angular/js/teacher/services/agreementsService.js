'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('agreementsService', ['$resource',
        function ($resource) {
            var url = basePath+'/_teacher/_accountant/agreements';
            return $resource(
                '',
                {},
                {
                    list: {
                        url: url + '/getAgreementsList',
                        method: 'GET'
                    },
                    confirm: {
                        url: url + '/confirm',
                        method: 'GET'
                    },
                    cancel: {
                        url: url + '/cancel',
                        method: 'GET'
                    },
                    getById: {
                        url: url + '/getAgreement'
                    },
                    typeahead: {
                        url: url + '/getTypeahead',
                        isArray:true
                    }
                });
        }]);

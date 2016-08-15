'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('agreements', ['$resource',
        function ($resource) {
            var url = '/_teacher/_accountant/agreements';
            return $resource(
                '',
                {},
                {
                    list: {
                        url: url + '/getAgreementsList',
                        method: 'GET',
                        params: {
                            page: 'page',
                            pageCount: 'pageCount'
                        }
                    },
                    confirm: {
                        url: url + '/confirm',
                        method: 'GET',
                        params: {
                            id: 'id'
                        }
                    },
                    cancel: {
                        url: url + '/cancel',
                        method: 'GET',
                        params: {
                            id: 'id'
                        }
                    },
                    getById: {
                        url: url + '/getAgreement',
                        params: {
                            id:'id'
                        }
                    }
                });
        }]);

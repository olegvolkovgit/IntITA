'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('agreements', ['$resource',
    function ($resource) {
        var url = '/_teacher/_accountant/agreements/getAgreementsList';

        return $resource(
            url,
            {
                page: 'page',
                limit: 'limit'
            },
            {
                list: {
                    method: 'GET',
                    params: {
                        page: 'page',
                        limit: 'limit'
                    }
                }
            });
    }]);

'use strict';

/* Services */

var agreementsService = angular.module('agreementsService', ['ngResource']);

agreementsService.factory('agreementsService', ['$resource',
    function ($resource) {
        var url = '/_teacher/_accountant/agreements/getAgreementsList';

        return $resource(
            url,
            {
                page: 'page',
                limit: 'limit'
            },
            {
                agreementsList: {
                    method: 'GET',
                    params: {
                        page: 'page',
                        limit: 'limit'
                    },
                    isArray: true
                }
            });
    }]);

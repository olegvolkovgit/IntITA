'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('userSpecialOfferService', ['$resource',
        function ($resource) {
            var url = basePath + '/_teacher/_accountant/specialOffer';
            return $resource(
                '',
                {},
                {
                    list: {
                        url: url + '/getUserOffersNgTable'
                    }
                }
            );
        }]);

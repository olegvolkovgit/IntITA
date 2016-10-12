"use strict";

angular
    .module('teacherApp')
    .directive('userSpecialOfferTable', ['userSpecialOfferService', 'NgTableParams', userSpecialOfferTable]);

function userSpecialOfferTable(userSpecialOffer, NgTableParams) {

    function link($scope, element, attrs) {

        $scope.userSpecialOfferTable = new NgTableParams({}, {
            getData: function (params) {
                return userSpecialOffer 
                    .list(params.url())
                    .$promise
                    .then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    });
            }
        });

    }

    return {
        link: link,
        templateUrl: basePath+'/angular/js/teacher/templates/accountancy/userSpecialOffersTable.html'
    }
}


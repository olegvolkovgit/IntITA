"use strict";

angular
    .module('teacherApp')
    .directive('moduleSpecialOfferTable', ['moduleSpecialOfferService', 'NgTableParams', moduleSpecialOfferTable]);

function moduleSpecialOfferTable(moduleSpecialOffer, NgTableParams) {

    function link($scope, element, attrs) {

        $scope.moduleSpecialOfferTable = new NgTableParams({}, {
            getData: function (params) {
                return moduleSpecialOffer 
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
        templateUrl: basePath+'/angular/js/teacher/templates/accountancy/moduleSpecialOffersTable.html'
    }
}


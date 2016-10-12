"use strict";

angular
    .module('teacherApp')
    .directive('courseSpecialOfferTable', ['courseSpecialOfferService', 'NgTableParams', courseSpecialOfferTable]);

function courseSpecialOfferTable(courseSpecialOffer, NgTableParams) {

    function link($scope, element, attrs) {

        $scope.courseSpecialOfferTable = new NgTableParams({}, {
            getData: function (params) {
                return courseSpecialOffer
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
        templateUrl: basePath+'/angular/js/teacher/templates/accountancy/courseSpecialOffersTable.html'
    }
}


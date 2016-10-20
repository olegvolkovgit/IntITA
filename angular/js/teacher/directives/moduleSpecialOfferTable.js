"use strict";

angular
    .module('teacherApp')
    .directive('moduleSpecialOfferTable', ['paymentSchemaService', 'NgTableParams', moduleSpecialOfferTable]);

function moduleSpecialOfferTable(paymentSchema, NgTableParams) {

    function link($scope, element, attrs) {

        $scope.moduleSpecialOfferTable = new NgTableParams({}, {
            getData: function (params) {
                return paymentSchema
                    .moduleList(params.url())
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


"use strict";

angular
    .module('teacherApp')
    .directive('externalPaymentsTable', ['externalPaymentsService', 'NgTableParams', externalPaymentsTable]);

function externalPaymentsTable(externalPayments, NgTableParams) {

    function link($scope, element, attrs) {

        $scope.externalPaymentsTableParams = new NgTableParams({}, {
            getData: function (params) {
                return externalPayments
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
        templateUrl: basePath+'/angular/js/teacher/templates/accountancy/externalPaymentsTable.html'
    }
}


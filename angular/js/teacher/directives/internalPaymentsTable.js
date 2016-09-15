"use strict";

angular
    .module('teacherApp')
    .directive('internalPaymentsTable', ['internalPaymentsService', 'NgTableParams', internalPaymentsTable]);

function internalPaymentsTable(internalPayments, NgTableParams) {

    function link($scope, element, attrs) {

        console.log('DEADBEEF internalPaymentsTable.js:11');
        $scope.internalPaymentsTableParams = new NgTableParams({}, {
            getData: function (params) {
                return internalPayments
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
        templateUrl: basePath+'/angular/js/teacher/templates/accountancy/internalPaymentsTable.html'
    }
}


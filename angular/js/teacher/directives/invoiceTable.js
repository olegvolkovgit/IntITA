"use strict";

angular
    .module('teacherApp')
    .directive('invoiceTable', ['invoices', 'NgTableParams', invoiceTable]);

function invoiceTable(invoices, NgTableParams) {

    function link($scope, element, attrs) {

        $scope.invoiceTableParams = new NgTableParams({}, {
            getData: function (params) {
                return invoices
                    .list({
                        page: params.page(),
                        pageCount: params.count(),
                        agreementId: $scope.agreementId
                    })
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
        templateUrl: '/angular/js/teacher/templates/accountancy/invoicesTable.html'
    }
}


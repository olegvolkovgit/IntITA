"use strict";

angular
    .module('teacherApp')
    .directive('invoiceTable', ['invoicesService', 'NgTableParams', invoiceTable]);

function invoiceTable(invoices, NgTableParams) {

    function link($scope, element, attrs) {

        attrs.$observe('agreementId', function(value) {
            $scope.invoiceTableParams.reload();
        });

        $scope.invoiceTableParams = new NgTableParams({}, {
            getData: function (params) {
                return invoices
                    .list({
                        page: params.page(),
                        pageCount: params.count(),
                        agreementId: attrs.agreementId || $scope.agreementId
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
        templateUrl: basePath+'/angular/js/teacher/templates/accountancy/invoicesTable.html'
    }
}


"use strict";

angular
    .module('teacherApp')
    .directive('invoiceTable', ['invoicesService', 'NgTableParams', 'lodash', invoiceTable]);

function invoiceTable(invoices, NgTableParams, _) {

    function link($scope, element, attrs) {

        $scope.invoiceTableParams = new NgTableParams({}, {
            getData: function (params) {
                return invoices
                    .list(_.assign(
                        {
                            'extraParams[agreement_id]' : attrs.agreementId
                        }, params.url()))
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
        templateUrl: basePath + '/angular/js/teacher/templates/accountancy/invoicesTable.html'
    }
}


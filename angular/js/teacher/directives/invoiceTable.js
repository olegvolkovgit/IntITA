"use strict";

angular
    .module('teacherApp')
    .directive('invoiceTable', ['invoicesService', 'NgTableParams', 'lodash', invoiceTable]);

function invoiceTable(invoices, NgTableParams, _) {

    function link($scope, element, attrs) {
        $scope.invoiceTableParams = new NgTableParams({sorting: { date_created: "desc" } }, {
            getData: function (params) {
                return invoices
                    .list(_.assign(
                        {
                            'extraParams[agreement_id]' : attrs.agreementId
                        }, params.url()))
                    .$promise
                    .then(function (data) {
                        $scope.currentDate = currentDate;
                        params.total(data.count);
                        data.rows.forEach(function(row) {
                            var paid = 0;
                            //get paid sum for agreement
                            row.internalPayment.forEach(function (pay) {
                                paid = paid + Number(pay.summa);
                            });
                            row.paidAmount = paid;
                        });
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


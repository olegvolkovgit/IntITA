"use strict";

angular
    .module('teacherApp')
    .directive('invoiceDetailed', ['invoicesService', invoiceDetailed]);

function invoiceDetailed(invoices) {

    function link($scope, element, attrs) {
        invoices
            .getByParams({id: attrs.invoiceId || 0})
            .$promise
            .then(function (data) {
                $scope.invoiceData = data.rows[0];
                $scope.invoiceData.currentDate = currentDate;
            });
    }

    return {
        link: link,
        templateUrl: basePath + '/angular/js/teacher/templates/accountancy/invoiceDetailed.html'
    }
}


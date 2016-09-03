"use strict";

angular
    .module('teacherApp')
    .directive('findExternalPayment', ['externalPaymentsService', 'lodash', addExternalPayment]);

function addExternalPayment(externalPayments, _) {

    function link($scope, element, attrs) {
        $scope.getExternalPaymentTypeahead = function (value) {
            return externalPayments
                .typeahead({
                    query: value
                })
                .$promise
        };

        $scope.formatLabel = function (item) {
            return item ? '№' + item.documentNumber + ' від ' + item.documentDate + ' (сума ' + item.amount + ' грн)' : null;
        };

        $scope.onSelect = function onSelect($item, $model, $label, $event) {
            _.assignIn($scope.document, $model);
        };
    }

    return {
        scope: {
            'document': '=document'
        },
        link: link,
        templateUrl: '/angular/js/teacher/templates/accountancy/findExternalPayment.html'
    }
}
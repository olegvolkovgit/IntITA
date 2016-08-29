"use strict";

angular
    .module('teacherApp')
    .directive('addExternalPayment', ['externalSourcesService', 'externalPaymentsService', addExternalPayment]);

function addExternalPayment(externalSources, externalPayments) {

    function link($scope, element, attrs) {
        $scope.sourcesList = [];

        externalSources
            .list()
            .$promise
            .then(function (data) {
                $scope.sourcesList = data;
            });

        $scope.saveExternalPayment = function saveExternalPayment() {
            externalPayments
                .create($scope.document)
                .$promise
                .then(function (data) {
                    console.log(data);
                    if (data.status && data.status == 'error') {
                        console.log(data);
                    } else {
                        for (var element in data) {
                            $scope.document[element] = data[element];
                        }
                    }
                })
        }
    }

    return {
        scope: {
            'document': '=document',
            'showSaveButton': '=showSaveButton'
        },
        link: link,
        templateUrl: '/angular/js/teacher/templates/accountancy/addExternalPayment.html'
    }
}
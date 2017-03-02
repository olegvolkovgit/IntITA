"use strict";

angular
    .module('teacherApp')
    .directive('agreementDetailed', ['agreementsService','lodash', agreementDetailed]);

function agreementDetailed(agreements, _) {
    function link($scope, element, attrs) {
        agreements
            .getById({id: attrs.agreementId || 0})
            .$promise
            .then(function (data) {
                $scope.agreementData = data;
                $scope.agreementData.currentDate = currentDate;
                var paid=0;
                //get paid sum for agreement
                if($scope.agreementData.internalPayment){
                    for (var index = 0; index < Object.keys($scope.agreementData.internalPayment).length; ++index){
                        paid = paid+Number($scope.agreementData.internalPayment[index].summa);
                    }
                }
                $scope.agreementData.paidAmount=paid;
                //get agreement payment_date and expiration_date
                if($scope.agreementData.invoice){
                    for (var index = 0; index < Object.keys($scope.agreementData.invoice).length; ++index) {
                        var invoicePaid=0;
                        _.filter($scope.agreementData.internalPayment, ['invoice_id', $scope.agreementData.invoice[index].id]).forEach(function (pay) {
                            invoicePaid = invoicePaid+Number(pay.summa);
                        });
                        if(invoicePaid<$scope.agreementData.invoice[index].summa){
                            $scope.agreementData.payment_date=$scope.agreementData.invoice[index].payment_date;
                            $scope.agreementData.expiration_date=$scope.agreementData.invoice[index].expiration_date;
                            break;
                        }
                    }
                }
            });

        $scope.cancel = function (id) {
            bootbox.confirm('Ви впевнені, що хочете скасувати договір?', function(result) {
                if(result){
                    return agreements
                        .cancel({id: id})
                        .$promise
                        .then(function () {
                            location.reload();
                        });
                }
            });
        };
    }

    return {
        link: link,
        templateUrl: basePath+'/angular/js/teacher/templates/accountancy/agreementDetailed.html'
    }
}


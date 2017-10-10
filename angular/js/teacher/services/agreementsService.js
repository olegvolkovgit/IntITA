'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('agreementsService', ['$resource','transformRequest',
        function ($resource, transformRequest) {
            var url = basePath+'/_teacher/_accountant/agreements';
            return $resource(
                '',
                {},
                {
                    list: {
                        url: url + '/getAgreementsList',
                        method: 'GET'
                    },
                    confirm: {
                        url: url + '/confirm',
                        method: 'GET'
                    },
                    cancel: {
                        url: url + '/cancel',
                        method: 'GET'
                    },
                    getById: {
                        url: url + '/getAgreement'
                    },
                    typeahead: {
                        url: url + '/getTypeahead',
                        isArray:true
                    },
                    userAgreements: {
                        url: url + '/getUserAgreementsList',
                        method: 'GET'
                    },
                    trainerUsersAgreements: {
                        url: basePath+'/_teacher/_trainer/trainer/getTrainerUsersAgreementsList',
                        method: 'GET'
                    },
                    getActualWrittenAgreementRequests: {
                        url: url + '/getActualWrittenAgreementRequestsCount',
                    },
                    agreementsRequestsList : {
                        url: url + '/getAgreementRequestsNgTable'
                    },
                    getWrittenAgreementData: {
                        url: url + '/getWrittenAgreementData'
                    },
                    getAgreementContract: {
                        url: url + '/getAgreementContract'
                    },
                    approveAgreementRequest: {
                        url: url + '/approveAgreementRequest',
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        transformRequest : transformRequest.bind(null)
                    },
                    rejectAgreementRequest : {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/rejectAgreementRequest',
                        transformRequest : transformRequest.bind(null)
                    },
                    getAgreementRequestStatus: {
                        url: url + '/getAgreementRequestStatus'
                    },
                    getAgreementTemplate: {
                        url: basePath+'/_teacher/_accountant/template/getAgreementTemplate'
                    },
                });
        }])
    .service('agreementsInformation', ['lodash',
        function(_) {
        this.setInformation = function(data) {
            data.rows.forEach(function(row) {
                var paid=0;
                //get paid sum for agreement
                row.internalPayment.forEach(function (pay) {
                    paid = paid+Number(pay.summa);
                });
                row.paidAmount=parseFloat(paid).toFixed(2);
                //get agreement payment_date and expiration_date
                for (var index = 0; index < row.invoice.length; ++index) {
                    var invoicePaid=0;
                    _.filter(row.internalPayment, ['invoice_id', row.invoice[index].id]).forEach(function (pay) {
                        invoicePaid = invoicePaid+Number(pay.summa);
                    });
                    if(invoicePaid<row.invoice[index].summa){
                        row.payment_date=row.invoice[index].payment_date;
                        row.expiration_date=row.invoice[index].expiration_date;
                        break;
                    }
                }
            });
        };
    }])
    .directive('embedSrc', function () {
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                scope.$watch(
                    function() {
                        return attrs.embedSrc;
                    },
                    function() {
                        element.attr('src', attrs.embedSrc);
                    }
                );
            }
        };
    });
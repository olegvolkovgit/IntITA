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
                    getActualWrittenAgreements: {
                        url: url + '/getActualWrittenAgreementsCount',
                    },
                    agreementsRequestsList : {
                        url: url + '/getAgreementRequestsNgTable'
                    },
                    writtenAreementsList : {
                        url: url + '/getWrittenAgreementsNgTable'
                    },
                    writtenAreementsAppliedList : {
                        url: url + '/getWrittenAgreementsAppliedNgTable'
                    },
                    getWrittenAgreementData: {
                        url: url + '/getWrittenAgreementData'
                    },
                    getAgreementContract: {
                        url: url + '/getAgreementContract'
                    },
                    checkAgreementPdf: {
                        url: url + '/checkAgreementPdf'
                    },
                    approveAgreement: {
                        url: url + '/approveAgreement',
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        transformRequest : transformRequest.bind(null)
                    },
                    agreementRequestToUser: {
                        url: url + '/agreementRequestToUser',
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        transformRequest : transformRequest.bind(null)
                    },
                     cancelAgreementRequestToUser: {
                        url: url + '/cancelAgreementRequestToUser',
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
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: basePath+'/_teacher/_accountant/template/getAgreementTemplate',
                        transformRequest : transformRequest.bind(null)
                    },
                    writtenAgreementsTemplateList : {
                        url: basePath+'/_teacher/_accountant/template/getAgreementWrittenTemplateList'
                    },
                    getTemplatesList: {
                        url: basePath+'/_teacher/_accountant/template/getTemplatesList',
                        isArray:true
                    },
                    saveUpdateAgreement: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: basePath+'/_teacher/_accountant/template/saveUpdateAgreement',
                        transformRequest : transformRequest.bind(null)
                    },
                    cancelAppliedAgreement: {
                        url: url + '/cancelAppliedAgreement',
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        transformRequest : transformRequest.bind(null)
                    },
                    applyWrittenAgreementForService: {
                        url: basePath+'/_teacher/_accountant/template/applyWrittenAgreementForService',
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        transformRequest : transformRequest.bind(null)
                    },
                    createUserWrittenAgreement: {
                        url: url+'/createUserWrittenAgreement',
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        transformRequest : transformRequest.bind(null)
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
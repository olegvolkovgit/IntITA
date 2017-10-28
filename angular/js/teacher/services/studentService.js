'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('studentService', ['$resource','transformRequest',
        function ($resource, transformRequest) {
            var url = basePath+'/_teacher/_student/student';
            return $resource(
                '',
                {},
                {
                    invoicesByAgreement: {
                        url: url + '/getInvoicesByAgreement',
                        method: 'GET',
                    },
                    studentPlainTasksAnswers: {
                        url: url + '/getStudentPlainTasksAnswers',
                        method: 'GET',
                    },
                    newPlainTasksMarks: {
                        url: url + '/getNewPlainTasksMarksCount',
                        method: 'GET',
                    },
                    readNewPlainTasksMarks: {
                        url: url + '/readNewPlainTasksMarks',
                        method: 'GET',
                    },
                    writtenAgreementRequest: {
                        url: url + '/writtenAgreementRequest',
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        transformRequest : transformRequest.bind(null),
                    },
                    getWrittenAgreementData: {
                        url: url + '/getWrittenAgreementData'
                    },
                    writtenAgreementRequestStatus: {
                        url: url + '/writtenAgreementRequestStatus',
                        method: 'GET',
                    },
                    getAgreementContract: {
                        url: url + '/getAgreementContract'
                    },
                    checkAgreementPdf: {
                        url: url + '/checkAgreementPdf'
                    },
                    updateUserAgreementData: {
                        url: url + '/updateUserAgreementData',
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        transformRequest : transformRequest.bind(null),
                    },
                    updateUserData: {
                        url: url + '/updateUserData',
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        transformRequest : transformRequest.bind(null),
                    },
                    checkAgreementByUser: {
                        url: url + '/checkAgreementByUser',
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        transformRequest : transformRequest.bind(null)
                    },
                });
        }]);

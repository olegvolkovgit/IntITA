'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('studentService', ['$resource',
        function ($resource) { 
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
                    studentDataForWrittenAgreement: {
                        url: url + '/getDataForWrittenAgreement',
                        method: 'POST',
                    },
                });
        }]);

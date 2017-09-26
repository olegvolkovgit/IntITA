'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('trainerService', ['$resource',
        function ($resource) { 
            var url = basePath+'/_teacher/_trainer/trainer';
            return $resource(
                '',
                {},
                {
                    trainersStudentsList: {
                        url: url + '/getTrainersStudentsList',
                        method: 'GET'
                    },
                    studentsPersonalInfo: {
                        url: url + '/getPersonalInfo',
                        method: 'GET'
                    },
                    studentsCareerInfo: {
                        url: url + '/getCareerInfo',
                        method: 'GET'
                    },
                    studentContractInfo: {
                        url: url + '/getContractInfo',
                        method: 'GET'
                    },
                    studentVisitInfo: {
                        url: url + '/getVisitInfo',
                        method: 'GET'
                    },
                    updateStudentData: {
                        url: url + '/updateStudent',
                        method: 'GET'
                    },
                    getSpecializationGroup: {
                        url: url + '/getSpecializationGroup',
                        method: 'GET',
                        isArray: true
                    },
                    updateSpecialization: {
                        url: url + '/updateSpecialization',
                        method: 'GET'
                    },
                    changeFormStudy: {
                        url: url + '/changeFormStudy',
                        method: 'GET'
                    },
                    changeTimeStudy: {
                        url: url + '/changeTimeStudy',
                        method: 'GET'
                    },
                    getEducationForm: {
                        url: url + '/getEducationForm',
                        method: 'GET',
                        isArray: true
                    },
                    getEducationTime: {
                        url: url + '/getEducationTime',
                        method: 'GET',
                        isArray: true
                    },
                    getPayForm: {
                        url: url + '/getPayForm',
                        method: 'GET',
                        isArray: true
                    },
                    changePayForm: {
                        url: url + '/changePayForm',
                        method: 'GET'
                    },
                    getGroupNumber: {
                        url: url + '/getGroupNumber',
                        method: 'GET',
                        isArray: true
                    },
                    getCancelType: {
                        url: url + '/getCancelType',
                        method: 'GET',
                        isArray: true
                    }
                });
        }]);
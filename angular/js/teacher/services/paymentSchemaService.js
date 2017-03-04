'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('paymentSchemaService', ['$resource', 'transformRequest',
        function ($resource, transformRequest) {
            var url = basePath + '/_teacher/_accountant/paymentSchema',
                urlCourse = basePath + '/_teacher/_accountant/specialOffer',
                urlModule = basePath + '/_teacher/_accountant/specialOffer',
                urlUser = basePath + '/_teacher/_accountant/specialOffer',
                urlDefault = basePath + '/_teacher/_accountant/specialOffer';

            return $resource(
                '',
                {},
                {
                    query: {
                        url: url + '/getSchemas',
                        method: 'GET',
                        isArray: true
                    },
                    courseList: {
                        url: urlCourse + '/getCourseOffersNgTable'
                    },
                    moduleList: {
                        url: urlModule + '/getModuleOffersNgTable'
                    },
                    userList: {
                        url: urlUser + '/getUserOffersNgTable'
                    },
                    defaultList : {
                        url: urlDefault + '/getPaymentSchemasNgTable'
                    },
                    create : {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/createSchema',
                        transformRequest : transformRequest.bind(null)
                    },
                    schemesTemplatesList : {
                        url: url + '/getPaymentSchemasTemplatesNgTable'
                    },
                    mainAppliedTemplatesList : {
                        url: url + '/getMainAppliedTemplatesNgTable'
                    },
                    servicesAppliedTemplatesList : {
                        url: url + '/getServicesAppliedTemplatesNgTable'
                    },
                    promotionPaymentsSchemaList : {
                        url: url + '/getPromotionAppliedTemplatesNgTable'
                    },
                    usersAppliedTemplatesList : {
                        url: url + '/getUsersAppliedTemplatesNgTable'
                    },
                    applyTemplate : {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/applySchemesTemplate',
                        transformRequest : transformRequest.bind(null)
                    },
                    applyPromotionTemplate : {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/applyPromotionSchemesForService',
                        transformRequest : transformRequest.bind(null)
                    },
                    updatePromotionTemplate : {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: url + '/updatePromotionSchemesForService',
                        transformRequest : transformRequest.bind(null)
                    },
                });
        }])
;

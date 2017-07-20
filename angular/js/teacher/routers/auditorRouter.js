var auditorUrl = basePath+"/_teacher/_auditor",
    accountantUrl = basePath + "/_teacher/_accountant/";

angular
    .module('auditorRouter',['ui.router'])
    .config(function ($stateProvider) {
    $stateProvider
        .state('auditor', {
            url: "/auditor",
            cache: false,
            controller: function($scope){
                $scope.changePageHeader('Аудитор');
            },
            templateUrl: auditorUrl+"/auditor/index",
        })
        .state('auditor/offerTemplate', {
            url: "/auditor/offerTemplate",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Публічна оферта');
            },
            templateUrl: auditorUrl+"/template/index",
        })
        .state('auditor/updateOfferTemplate/:lang', {
            url: "/auditor/updateOfferTemplate/:lang",
            cache         : false,
            templateUrl: function ($stateParams) {
                return auditorUrl+"/template/editOffer/?lang="+$stateParams.lang;
            }
        })
        .state('auditor/writtenAgreement', {
            url: "/auditor/writtenAgreement",
            cache         : false,
            templateUrl: auditorUrl+"/template/writtenAgreement",
        })

        .state('auditor/updateWrittenAgreement', {
            url: "/auditor/updateWrittenAgreement",
            cache         : false,
            templateUrl: auditorUrl+"/template/updateWrittenAgreement",
        })

        .state('auditor/agreements', {
            url: "/auditor/agreements",
            cache: false,
            templateUrl: accountantUrl + "agreements/index?organization=0"
        })
        .state('auditor/invoices', {
            url: "/auditor/invoices",
            cache: false,
            templateUrl: accountantUrl + "invoices/index?organization=0"
        })
        .state('auditor/operation', {
            url: "/auditor/operation",
            cache: false,
            templateUrl: accountantUrl + "operation/index?organization=0"
        })
        .state('auditor/externalsources', {
            url: "/auditor/externalsources",
            cache: false,
            templateUrl: accountantUrl + "externalSources/index"
        })
        .state('auditor/cancelreasontype', {
            url: "/auditor/cancelreasontype",
            cache: false,
            templateUrl: auditorUrl + "/cancelReasonType/index"
        })
        .state('auditor/createCancelreasontype', {
            url: "/auditor/createCancelreasontype",
            cache: false,
            templateUrl: auditorUrl + "/cancelReasonType/create"
        })
        .state('auditor/cancelReasonType/view/:id', {
            url: "/auditor/cancelReasonType/view/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return auditorUrl+"/cancelReasonType/view/?id="+$stateParams.id;
            }
        })
        .state('auditor/cancelReasonType/update/:id', {
            url: "/auditor/cancelReasonType/update/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return auditorUrl+"/cancelReasonType/update/?id="+$stateParams.id;
            }
        })
});
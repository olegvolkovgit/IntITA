/**
 * Created by adm on 19.07.2016.
 */

var accountantUrl = basePath+"/_teacher/_accountant/";

angular
    .module('accountantRouter', ['ui.router']).

config(function ($stateProvider, $urlRouterProvider) {

    $stateProvider
        .state('accountant', {
            url: "/accountant",
            cache         : false,
            templateUrl: accountantUrl+"accountant/index"
        })
        .state('accountant/agreements', {
            url: "/accountant/agreements",
            cache         : false,
            templateUrl: accountantUrl+"agreements/index"
        })
        .state('accountant/agreement/', {
            url: "/accountant/agreement/{agreementId:[0-9]*}",
            cache         : false,
            templateUrl: accountantUrl+"agreements/agreement"
        })
        .state('accountant/invoices', {
            url: "/accountant/invoices",
            cache         : false,
            templateUrl: accountantUrl+"invoices/index"
        })
        .state('accountant/invoice/', {
            url: "/accountant/invoice/{invoiceId:[0-9]*}",
            cache         : false,
            templateUrl: accountantUrl+"invoices/invoice"
        })
        .state('accountant/operation', {
            url: "/accountant/operation",
            cache         : false,
            templateUrl: accountantUrl+"operation/index/"
        })
        .state('accountant/operation/create', {
            url: "/accountant/operation/create",
            cache         : false,
            templateUrl: accountantUrl+"operation/create/"
        })
        .state('accountant/company', {
            url: "/accountant/company",
            cache         : false,
            templateUrl: accountantUrl+"company/index"
        })
        .state('accountant/representative', {
            url: "/accountant/representative",
            cache         : false,
            templateUrl: accountantUrl+"representative/index"
        })
        .state('accountant/template', {
            url: "/accountant/template",
            cache         : false,
            templateUrl: accountantUrl+"template/index"
        })
        .state('accountant/operationtype', {
            url: "/accountant/operationtype",
            cache         : false,
            templateUrl: accountantUrl+"operationType/index"
        })
        .state('accountant/externalsources', {
            url: "/accountant/externalsources",
            cache         : false,
            templateUrl: accountantUrl+"externalSources/index"
        })
        .state('accountant/cancelreasontype', {
            url: "/accountant/cancelreasontype",
            cache         : false,
            templateUrl: accountantUrl+"cancelReasonType/index"
        });
    }
);

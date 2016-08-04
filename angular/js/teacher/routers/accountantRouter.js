/**
 * Created by adm on 19.07.2016.
 */

var accountantUrl = "/_teacher/_accountant/";

angular
    .module('accountantRouter',['ui.router']).
config(function ($stateProvider, $urlRouterProvider) {

    $stateProvider
        .state('accoundant', {
            url: "/accoundant",
            cache         : false,
            templateUrl: accountantUrl+"accountant/index",
        })
        .state('accoundant/agreements', {
        url: "/accoundant/agreements",
        cache         : false,
        templateUrl: accountantUrl+"agreements/index",
        })
        .state('accoundant/invoices', {
            url: "/accoundant/invoices",
            cache         : false,
            templateUrl: accountantUrl+"invoices/index/",
        })
        .state('accoundant/operation', {
            url: "/accoundant/operation",
            cache         : false,
            templateUrl: accountantUrl+"operation/index/",
        })
        .state('accoundant/company', {
            url: "/accoundant/company",
            cache         : false,
            templateUrl: accountantUrl+"company/index",
        })
        .state('accoundant/representative', {
            url: "/accoundant/representative",
            cache         : false,
            templateUrl: accountantUrl+"representative/index",
        })
        .state('accoundant/template', {
            url: "/accoundant/template",
            cache         : false,
            templateUrl: accountantUrl+"template/index",
        })
        .state('accoundant/operationtype', {
            url: "/accoundant/operationtype",
            cache         : false,
            templateUrl: accountantUrl+"operationType/index",
        })
        .state('accoundant/externalsources', {
            url: "/accoundant/externalsources",
            cache         : false,
            templateUrl: accountantUrl+"externalSources/index",
        })
        .state('accoundant/cancelreasontype', {
            url: "/accoundant/cancelreasontype",
            cache         : false,
            templateUrl: accountantUrl+"cancelReasonType/index",
        });
    }
);

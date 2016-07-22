/**
 * Created by adm on 16.07.2016.
 */
angular
    .module('adminRouter',['ui.router']).
config(function ($stateProvider, $urlRouterProvider, $locationProvider) {
    $stateProvider
        .state('admin', {
            url: "/admin",
            cache         : false,
            templateUrl: "/_teacher/_admin/admin/index",
        })
        .state('admin/mainslider', {
            url: "/admin/mainslider",
            cache         : false,
            templateUrl: "/_teacher/_admin/carousel/index",
        })
        .state('admin/aboutusslider', {
            url: "/admin/aboutusslider",
            cache         : false,
            templateUrl: "/_teacher/_admin/aboutusSlider/index",
        })
        .state('admin/address', {
            url: "/admin/address",
            cache         : false,
            templateUrl: "/_teacher/_admin/address/index",
        })
        .state('admin/verifycontent', {
            url: "/admin/verifycontent",
            cache         : false,
            templateUrl: "/_teacher/_admin/verifyContent/index",
        })
        .state('admin/coursemanage', {
            url: "/admin/coursemanage",
            cache         : false,
            templateUrl: "/_teacher/_admin/coursemanage/index",
        })
        .state('admin/modulemanage', {
            url: "/admin/modulemanage",
            cache         : false,
            templateUrl: "/_teacher/_admin/module/index",
        })
        .state('admin/teachers', {
            url: "/admin/teachers",
            cache         : false,
            templateUrl: "/_teacher/_admin/teachers/index",
        })
        .state('admin/sharedlinks', {
            url: "/admin/sharedlinks",
            cache         : false,
            templateUrl: "/_teacher/_admin/shareLink/index",
        })
        .state('admin/response', {
            url: "/admin/response",
            cache         : false,
            templateUrl: "/_teacher/_admin/response/index",
        })
        .state('admin/graduate', {
            url: "/admin/graduate",
            cache         : false,
            templateUrl: "/_teacher/_admin/graduate/index",
        })
        .state('admin/freelectures', {
            url: "/admin/freelectures",
            cache         : false,
            templateUrl: "/_teacher/_admin/freeLectures/index",
        })
        .state('admin/permissions', {
            url: "/admin/permissions",
            cache         : false,
            templateUrl: "/_teacher/_admin/permissions/index",
        })
        .state('admin/pay', {
            url: "/admin/pay",
            cache         : false,
            templateUrl: "/_teacher/_admin/pay/index",
        })
        .state('admin/cancel', {
            url: "/admin/cancel",
            cache         : false,
            templateUrl: "/_teacher/_admin/pay/cancelCourseModule",
        })
        .state('admin/users', {
            url: "/admin/users",
            cache         : false,
            templateUrl: "/_teacher/_admin/users/index",
        })
        .state('admin/refreshcache', {
            url: "/admin/refreshcache",
            cache         : false,
            templateUrl: "/_teacher/_admin/config/refresh",
        })
        .state('admin/levels', {
            url: "/admin/levels",
            cache         : false,
            templateUrl: "/_teacher/_admin/level/index",
        })
        .state('admin/config', {
            url: "/admin/config",
            cache         : false,
            templateUrl: "/_teacher/_admin/config/index",
        })
        .state('admin/old', {
            url: "/admin/old",
            cache         : false,
            templateUrl: "/_teacher/_admin/old/index",
        });
    }
);

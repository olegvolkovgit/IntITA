'use strict';
angular.module('chatIntITAMessenger', []);

angular
    .module('teacherApp', [
        'checklist-model',
        'datatables',
        'ui.bootstrap',
        'ngBootbox',
        'directive.loading',
        'ngResource',
        'ngTable',
        'ngToast',
        'angular-loading-bar',
        'freeLecturesRouter',
        'messagesRouter',
        'cabinetRouter',
        'adminRouter',
        'authorRouter',
        'consultantRouter',
        'teacherConsultantRouter',
        'trainerRouter',
        'studentRouter',
        'tenantRouter',
        'accountantRouter',
        'contentManagerRouter',
        'modulesRouter',
        'graduatesRouter',
        'sharedLinksRouter',
        'responseRouter',
        'interfaceMessagesRouter',
        'siteConfigRouter',
        'requestsRouter',
        'superVisorRouter',
        'newsletterRouter',
        'oi.select',
        'ngCkeditor',
        'schedulerTasks',
        'paymentsSchemes.directives',
        'chatIntITAMessenger',
        'directorRouter',
        'superAdminRouter',
        'auditorRouter',
        'ngImgCrop',
        'crmApp',
        'vxWamp',
        'angularTreeview',
        'contentProgressApp'
    ])
    .filter('shortDate', [
            '$filter', function($filter) {
                    return function(input, format) {
                            return input ? $filter('date')(new Date(input), format) : '';
                    };
            }
    ])
    .filter('bracket', [
            '$filter', function() {
                    return function(input) {
                            return input ? '['+input+']' : '';
                    };
            }
    ])
    .run(['$rootScope', '$templateCache','$state',
            function ($rootScope, $templateCache, $state) {
                    $rootScope.$on('$stateChangeStart', function (event, toState, toParams, fromState, fromParams) {
                            $templateCache.remove(fromState.templateUrl);
                    });
                    $rootScope.$on('$stateChangeSuccess',
                        function () {
                            setTimeout(function() {
                                MathJax.Hub.Config({
                                    tex2jax: {
                                        inlineMath: [['$','$'], ['\\(','\\)']]
                                    },
                                    "HTML-CSS": {
                                        linebreaks: { automatic: true }
                                    },
                                    SVG: {
                                        linebreaks: { automatic: true }
                                    }
                                });
                                MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
                            });
                        });
            }]);
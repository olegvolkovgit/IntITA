'use strict';
angular.module('chatIntITAMessenger', []);

/* App Module */
angular
    .module('mainApp', [
        'mainApp.directives',
        'ui.bootstrap',
        'oi.select',
        'ngResource',
        'paymentsSchemes.directives',
        'ngSanitize',
        'ui.select',
        'chatIntITAMessenger',
        'angularFileUpload',
        'angular-loading-bar',
        'ngImgCrop',
        'ngBootbox',
        'angular-carousel'
    ]);
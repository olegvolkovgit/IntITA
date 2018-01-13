'use strict';

angular
    .module('crmApp', [
        'crmRouter',
        'ngDraggable',
        'angularFileUpload',
    ])
    .filter('trustAsHtml',['$sce', function($sce) {
        return function(text) {
            return $sce.trustAsHtml(text);
        };
    }])
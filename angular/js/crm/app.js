'use strict';

angular
    .module('crmApp', [
        'crmRouter',
        'ngDraggable',
    ])
    .filter('trustAsHtml',['$sce', function($sce) {
        return function(text) {
            return $sce.trustAsHtml(text);
        };
    }])
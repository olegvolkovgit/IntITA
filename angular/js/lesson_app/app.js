'use strict';
angular.module('chatIntITAMessenger', []);

/* App Module */
angular
    .module('lessonApp', ['ui.bootstrap', 'ipCookie','ui.router','hljs','ui.codemirror','chatIntITAMessenger', 'ngSanitize', 'ui.bootstrap', 'ngResource','interpreterJsonFilter','interpreterModule'])
    .filter('unsafe', ['$sce', function ($sce) {
        return function (text) {
            return $sce.trustAsHtml(text.replace(/'/g, '\\'));
        };
    }]);
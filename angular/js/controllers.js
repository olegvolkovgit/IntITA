'use strict';

/* Controllers */
var app = angular.module('lessonApp', ['ui.bootstrap']);

app.controller('sidebarCtrl', function($scope) {

});

// Declare app level module which depends on filters, and services
angular.module('mainApp', ['mainApp.directives']);

/* Controllers */
function validationController($scope) {

}

/* Directives */
angular.module('mainApp.directives', [])
    .directive('pwCheck', [function () {
        return {
            require: 'ngModel',
            link: function (scope, elem, attrs, ctrl) {
                var me = attrs.ngModel;
                var matchTo = attrs.pwCheck;
                scope.$watchGroup([me, matchTo], function(value){
                    ctrl.$setValidity('pwmatch', value[0] === value[1] );
                });
            }
        }
    }])
    .controller('validationController', validationController);
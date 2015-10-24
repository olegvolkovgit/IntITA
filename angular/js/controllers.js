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
    .directive('fileCheck', function() {
        var validFormats = ['jpg', 'png', 'gif'];
        return {
            require: 'ngModel',
            link: function(scope, element, attributes, ngModelController) {
                var maxFileSize = Number(attributes.maxFileSize) || Number.MAX_VALUE;
                element.bind('change', function() {
                    var file = this.files[0];
                    ngModelController.$setValidity('size', file.size <= maxFileSize);
                    var value = element.val(),
                        ext = value.substring(value.lastIndexOf('.') + 1).toLowerCase();
                    ngModelController.$setValidity('fileType', validFormats.indexOf(ext) !== -1);
                    //console.log(ngModelController);
                    scope.$apply();
                });
            }
        };
    })
    .controller('validationController', validationController);

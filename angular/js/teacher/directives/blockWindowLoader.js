"use strict";

angular
    .module('teacherApp')
    .directive('blockWindowLoader', [showLoader]);

function showLoader() {

    function link($scope, element, attrs) {
        $scope.control = $scope;

        $scope.control.isShow = false;

        $scope.control.show = function () {
            $scope.control.isShow = true;
        };

        $scope.hide = function () {
            $scope.control.isShow = false;
        };

        $scope.toggle = function () {
            $scope.control.isShow = !$scope.control.isShow;
        };
    }

    return {
        link: link,
        scope: {
            control: '=control'
        },
        templateUrl: '/angular/js/teacher/templates/blockWindowLoader.html'
    }
}
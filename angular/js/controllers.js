'use strict';

/* Controllers */
var app = angular.module('lessonApp', ['ui.bootstrap']);

app.controller('sidebarCtrl', function($scope) {
    $scope.addLectureClass = function(lectureClass) {
        $scope.billetClass = lectureClass;
    }
});
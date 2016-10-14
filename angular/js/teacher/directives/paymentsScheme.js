"use strict";

angular
    .module('teacherApp')
    .directive('paymentsSchemeOnline', ['paymentsService', paymentsSchemeOnline])
    .directive('paymentsSchemeOffline', ['paymentsService', paymentsSchemeOffline]);

function paymentsSchemeOnline(schemes) {

    function link($scope, element, attrs) {
        schemes
            .scheme({courseId: attrs.courseId,educationFormId:1})
            .$promise
            .then(function (data) {
                $scope.onlineSchemeData = data;
            });
    }

    return {
        link: link,
        templateUrl: basePath + '/angular/js/main_app/templates/paymentsSchemeOnline.html'
    }
}

function paymentsSchemeOffline(schemes) {

    function link($scope, element, attrs) {
        schemes
            .scheme({courseId: attrs.courseId,educationFormId:2})
            .$promise
            .then(function (data) {
                $scope.offlineSchemeData = data;
            });
    }

    return {
        link: link,
        templateUrl: basePath + '/angular/js/main_app/templates/paymentsSchemeOffline.html'
    }
}

"use strict";

angular
    .module('teacherApp')
    .directive('agreementDetailed', ['agreements', agreementDetailed]);

function agreementDetailed(agreements) {

    function link($scope, element, attrs) {
        agreements
            .getById({id: $scope.agreementId})
            .$promise
            .then(function (data) {
                $scope.agreementData = data;
            });
    }

    return {
        link: link,
        templateUrl: '/angular/js/teacher/templates/accountancy/agreementDetailed.html'
    }
}


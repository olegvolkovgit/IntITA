"use strict";

angular
    .module('teacherApp')
    .directive('agreementDetailed', ['agreementsService', agreementDetailed]);

function agreementDetailed(agreements) {

    function link($scope, element, attrs) {
        agreements
            .getById({id: attrs.agreementId || 0})
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


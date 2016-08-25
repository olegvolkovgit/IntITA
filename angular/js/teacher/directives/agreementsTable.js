"use strict";

angular
    .module('teacherApp')
    .directive('agreementsTable', ['agreementsService', '$state', 'NgTableParams', agreementsTable]);

function agreementsTable(agreements, $state, NgTableParams) {

    function link($scope, element, attrs) {

        $scope.agreementsTableParams = new NgTableParams({}, {
            getData: function (params) {
                return agreements
                    .list({
                        page: params.page(),
                        pageCount: params.count()
                    })
                    .$promise
                    .then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    });
            }
        });

        $scope.confirm = function (id) {
            return agreements
                .confirm({id: id})
                .$promise
                .then(function (data) {
                    $scope.agreementsTableParams.reload();
                    return data;
                });
        };

        $scope.cancel = function (id) {
            return agreements
                .cancel({id: id})
                .$promise
                .then(function (data) {
                    $scope.agreementsTableParams.reload();
                    return data;
                });
        };

        $scope.showAgreement = function (id) {
            $state.go('accountant/agreement/', {agreementId:id});
        }

    }

    return {
        link: link,
        templateUrl: basePath+'/angular/js/teacher/templates/accountancy/agreementsTable.html'
    }
}


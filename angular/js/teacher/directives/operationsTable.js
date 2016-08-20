"use strict";

angular
    .module('teacherApp')
    .directive('operationsTable', ['operationsService', 'NgTableParams', operationsTable]);

function operationsTable(operations, NgTableParams) {

    function link($scope, element, attrs) {

        $scope.operationsTableParams = new NgTableParams({}, {
            getData: function (params) {
                return operations
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

    }

    return {
        link: link,
        templateUrl: '/angular/js/teacher/templates/accountancy/operationsTable.html'
    }
}


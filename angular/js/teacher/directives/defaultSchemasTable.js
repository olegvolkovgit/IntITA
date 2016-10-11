"use strict";

angular
    .module('teacherApp')
    .directive('defaultSchemasTable', ['defaultSchemasService', 'NgTableParams', courseSpecialOfferTable]);

function courseSpecialOfferTable(defaultSchemas, NgTableParams) {

    function link($scope, element, attrs) {

        $scope.courseSpecialOfferTable = new NgTableParams({}, {
            getData: function (params) {
                return defaultSchemas
                    .list(params.url())
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
        templateUrl: basePath+'/angular/js/teacher/templates/accountancy/defaultSchemasTable.html'
    }
}


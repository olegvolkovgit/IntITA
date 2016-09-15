/**
 * Created by adm on 26.07.2016.
 */
angular
    .module('teacherApp').
    controller('studentCtrl', studentCtrl)
    .controller('studentFinancesCtrl', function ($scope) {
        initPayCoursesList();
        initPayModulesTable();
        initAgreementsTable();
    });

function studentCtrl($scope, $http, NgTableParams,$resource) {



    $scope.getTodayConsultations = function() {
        initTodayConsultationsTable();

        // NEXT iteration
        //$scope.todayConsultationsTable = new NgTableParams({
        //    page: 1,
        //    count: 10
        //}, {
        //    getData: function (params) {
        //        return $resource(basePath + '/_teacher/_student/student/getTodayConsultationsList').get(params.url()).$promise.then(function (data) {
        //            params.total(data.count);
        //            return data.rows;
        //        });
        //    }
        //});
    };
    $scope.getPastConsultations = function(){
        $scope.pastConsultationsTable = new NgTableParams({
            page: 1,
            count: 10
        }, {
            getData: function (params) {
                return $resource(basePath+'/_teacher/_student/student/getPastConsultationsList').get(params.url()).$promise.then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
            }
        });
    }

    $scope.getCanceledConsultations = function(){
        $scope.canceledConsultationsTable = new NgTableParams({
            page: 1,
            count: 10
        }, {
            getData: function (params) {
                return $resource(basePath+'/_teacher/_student/student/getCancelConsultationsList').get(params.url()).$promise.then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
            }
        });
    }

    $scope.getPlannedConsultations = function(){
        $scope.plannedConsultationsTable = new NgTableParams({
            page: 1,
            count: 10
        }, {
            getData: function (params) {
                return $resource(basePath+'/_teacher/_student/student/getPlannedConsultationsList').get(params.url()).$promise.then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
            }
        });
    }
}
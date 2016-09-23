/**
 * Created by adm on 19.07.2016.
 */
angular
    .module('teacherApp')
    .controller('consultantModulesCtrl', function ($scope){
        $jq(document).ready(function () {
            $jq('#consultantModulesTable').DataTable({
                    "autoWidth": false,
                    language: {
                        "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                    },
                    "columns": [
                        null,
                        {
                            "type": "de_date", targets: 1,
                        },
                    ]
                }
            );
        });
    })
    .controller('consultantCtrl',function($scope, $resource, NgTableParams, $http, $state){

        $scope.getTodayConsultations = function() {
            initTodayConsultationsTable();

            // NEXT iteration
            $scope.todayConsultationsTable = new NgTableParams({
                page: 1,
                count: 10
            }, {
                getData: function (params) {
                    return $resource(basePath + '/_teacher/_consultant/consultant/getTodayConsultationsList').get(params.url()).$promise.then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    });
                }
            });
        };
        $scope.getPastConsultations = function(){
            $scope.pastConsultationsTable = new NgTableParams({
                page: 1,
                count: 10
            }, {
                getData: function (params) {
                    return $resource(basePath+'/_teacher/_consultant/consultant/getPastConsultationsList').get(params.url()).$promise.then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    });
                }
            });
        };

        $scope.getCanceledConsultations = function(){
            $scope.canceledConsultationsTable = new NgTableParams({
                page: 1,
                count: 10
            }, {
                getData: function (params) {
                    return $resource(basePath+'/_teacher/_consultant/consultant/getCancelConsultationsList').get(params.url()).$promise.then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    });
                }
            });
        };

        $scope.getPlannedConsultations = function(){
            $scope.plannedConsultationsTable = new NgTableParams({
                page: 1,
                count: 10
            }, {
                getData: function (params) {
                    return $resource(basePath+'/_teacher/_consultant/consultant/getPlannedConsultationsList').get(params.url()).$promise.then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    });
                }
            });
        };

        $scope.cancelConsultation = function(consultationId){
            bootbox.confirm('Відмінити консультацію?,',function(result){
                if (result){
                    $http({
                        method:'POST',
                        url:basePath+'/_teacher/_consultant/consultant/cancelConsultation?id='+consultationId,
                    }).success(function(response){
                        if (response==='success'){
                            $state.go('consultant/consultations');
                        }
                        else{
                            bootbox.alert('Что-то пошло не так!')
                        }
                    }).error(function(){
                        bootbox.alert('Что-то пошло не так!')
                    })
                }
            })
        }
        //initTodayTeacherConsultationsTable();
        //initPlannedTeacherConsultationsTable();
        //initPastTeacherConsultationsTable();
        //initCancelTeacherConsultationsTable();
    })
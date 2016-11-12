/**
 * Created by adm on 26.07.2016.
 */
angular
    .module('teacherApp')
    .controller('studentCtrl', studentCtrl)
    .controller('offlineEducationCtrl', offlineEducationCtrl)
    .controller('studentFinancesCtrl', function ($scope) {
        initPayCoursesList();
        initPayModulesTable();
        initAgreementsTable();
    });

function studentCtrl($scope, $http, NgTableParams,$resource, $state, $location) {


    $scope.getTodayConsultations = function() {
        initTodayConsultationsTable();

        // NEXT iteration
        $scope.todayConsultationsTable = new NgTableParams({
            page: 1,
            count: 10
        }, {
            getData: function (params) {
                return $resource(basePath + '/_teacher/_student/student/getTodayConsultationsList').get(params.url()).$promise.then(function (data) {
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
                return $resource(basePath+'/_teacher/_student/student/getPastConsultationsList').get(params.url()).$promise.then(function (data) {
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
                return $resource(basePath+'/_teacher/_student/student/getCancelConsultationsList').get(params.url()).$promise.then(function (data) {
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
                return $resource(basePath+'/_teacher/_student/student/getPlannedConsultationsList').get(params.url()).$promise.then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
            }
        });
    };

    $scope.getStudentAreements = function(){
        $scope.agreementsTable = new NgTableParams({
            page: 1,
            count: 10
        }, {
            getData: function (params) {
                return $resource(basePath+'/_teacher/_student/student/getAgreementsList').get(params.url()).$promise.then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
            }
        });
    };

    $scope.getStudentPaidCourses = function(){
        $scope.paidCoursesTable = new NgTableParams({
            page: 1,
            count: 10
        }, {
            getData: function (params) {
                return $resource(basePath+'/_teacher/_student/student/getPayCoursesList').get(params.url()).$promise.then(function (data) {
                    params.total(data.count);
                    $scope.usd = data.usd;
                    return data.rows;
                });
            }
        });
    };
    $scope.usd = null;
    $scope.getStudentPaidModules = function(){
        $scope.paidModuesTable = new NgTableParams({
            page: 1,
            count: 10
        }, {
            getData: function (params) {
                return $resource(basePath+'/_teacher/_student/student/getPayModulesList').get(params.url()).$promise.then(function (data) {
                    params.total(data.count);
                    $scope.usd = data.usd;
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
                    url:basePath+'/_teacher/_student/student/cancelConsultation?id='+consultationId,
                }).success(function(response){
                    if (response==='success'){
                        $state.go('students/consultations');
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

    $scope.showStudentAgreement = function(agreementId, agreementName){
        $scope.changePageHeader('Договір'+ agreementName);
        $state.go('students/agreement/:agreementId',{agreementId:agreementId},{reload:true});
    };
}

function offlineEducationCtrl($scope, $http) {
    $scope.changePageHeader('Офлайн навчання');
    $http({
        method: 'POST',
        url: basePath+'/_teacher/_student/student/getOfflineEducationData',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).then(function successCallback(response) {
        $scope.subgroups=response.data;
    }, function errorCallback() {
        bootbox.alert("Завантажити дані офлайн навчання не вдалося. Зв\'яжіться з адміністрацією.");
    });
}
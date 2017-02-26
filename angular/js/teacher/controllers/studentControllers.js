/**
 * Created by adm on 26.07.2016.
 */
angular
    .module('teacherApp')
    .controller('studentCtrl', studentCtrl)
    .controller('offlineEducationCtrl', offlineEducationCtrl)
    .controller('invoicesByAgreement', invoicesByAgreement)
    .controller('studentPlainTasksCtrl', studentPlainTasksCtrl)
    .controller('studentPlainTaskViewCtrl', studentPlainTaskViewCtrl)
    .filter('htmlToShotPlaintext', function() {
        return function(text) {
            if(text){
                var str=String(text).replace(/<[^>]+>/gm, '').replace(/&nbsp;/gi,'').trim();
                if(str.length>50){
                    return str.substr(0, 50)+"..."
                }else{
                    return str;
                }
            }else return '';
        };
    })
    .filter('textToShotPlaintext', function() {
        return function(text) {
            if(text){
                var str=String(text).trim();
                if(str.length>50){
                    return str.substr(0, 50)+"..."
                }else{
                    return str;
                }
            }else return '';
        };
    })
    .filter('htmlToPlaintext', function() {
        return function(text) {
            if(text){
                return String(text).replace(/<[^>]+>/gm, '').replace(/&nbsp;/gi,'').trim();
            }else return '';
        };
    })

function studentCtrl($scope, $rootScope, $http, NgTableParams,$resource, $state, studentService) {
    $scope.getNewPlainTasksMarks=function(){
        studentService.newPlainTasksMarks()
            .$promise
            .then(function successCallback(response) {
                $rootScope.countOfNewPlainTasksMarks=response.data;
            }, function errorCallback() {
                console.log("Отримати дані про нові оцінки по простих завданнях не вдалося");
            });
    };
    $scope.getNewPlainTasksMarks();
    
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

    $scope.getStudentAgreements = function(){
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
                    //todo
                    data.rows.forEach(function(row) {
                        var paid=0;
                        row.internalPayment.forEach(function (pays) {
                            paid = paid+Number(pays.summa);
                        });
                        row.paidAmount=paid;
                    });
                    return data.rows;
                });
            }
        });
    };
    $scope.usd = null;
    $scope.getStudentPaidModules = function(){
        $scope.paidModulesTable = new NgTableParams({
            page: 1,
            count: 10
        }, {
            getData: function (params) {
                return $resource(basePath+'/_teacher/_student/student/getPayModulesList').get(params.url()).$promise.then(function (data) {
                    params.total(data.count);
                    //todo
                    data.rows.forEach(function(row) {
                        var paid=0;
                        row.internalPayment.forEach(function (pays) {
                            paid = paid+Number(pays.summa);
                        });
                        row.paidAmount=paid;
                    });
                    $scope.usd = data.usd;
                    return data.rows;
                });
            }
        });
    };

    $scope.cancelConsultation = function(consultationId){
        bootbox.confirm('Відмінити консультацію?',function(result){
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

function invoicesByAgreement($scope, NgTableParams, $stateParams, studentService) {
    $scope.changePageHeader('Договір/рахунки');

    $scope.invoiceUrl=basePath+'/invoice/';
    
    $scope.invoicesTable = new NgTableParams({}, {
        getData: function (params) {
            $scope.params=params.url();
            $scope.params.id=$stateParams.agreementId?$stateParams.agreementId:$scope.agreementId;
            return studentService
                .invoicesByAgreement($scope.params)
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    //get paid amount for each invoice
                    data.rows.forEach(function(row) {
                        var paid=0;
                        row.internalPayment.forEach(function (pays) {
                            paid = paid+Number(pays.summa);
                        });
                        row.paidAmount=paid;
                    });
                    return data.rows;
                });
        }
    });
}

function studentPlainTasksCtrl($scope, $rootScope, NgTableParams, studentService) {
    $scope.changePageHeader('Завдання з розгорнутою відповідю');
    //set new plain task marks as read
    $scope.readNewPlainTasksMarks=function(){
        studentService.readNewPlainTasksMarks()
            .$promise
            .then(function successCallback() {
                $rootScope.countOfNewPlainTasksMarks=0;
            }, function errorCallback() {
                console.log("Виникла помилка при спробі відмітити нові оцінки на прості задачі, як переглянуті");
            });
    };
    $scope.readNewPlainTasksMarks();

    $scope.marks = [{id:'0', title:'не зарах.'}, {id:'1', title:'зарах.'}, {id:'null', title:'не перевірено'}];

    $scope.studentPlainTasksAnswersTable = new NgTableParams({
        sorting: {
            'plainTaskMark.time': 'desc'
        },
    }, {
        getData: function (params) {
            return studentService
                .studentPlainTasksAnswers(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
}

function studentPlainTaskViewCtrl($scope, NgTableParams, $stateParams, studentService) {
    $scope.changePageHeader('Завдання з розгорнутою відповідю');

    $scope.studentPlainTasksAnswersTable = new NgTableParams({}, {
        getData: function (params) {
            $scope.params=params.url();
            $scope.params.id=$stateParams.id;
            return studentService
                .studentPlainTasksAnswers($scope.params)
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
}
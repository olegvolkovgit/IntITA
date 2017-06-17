/**
 * Created by adm on 19.07.2016.
 */
angular
    .module('teacherApp')
    .controller('teacherConsultantModulesCtrl', function ($scope) {
        $jq(document).ready(function () {
            $jq('#teacherModulesTable').DataTable({
                    "autoWidth": false,
                    language: {
                        "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                    }
                }
            );
        });
    })
    .controller('teacherConsultantTasksCtrl', function ($scope, $rootScope, $http, NgTableParams, $templateCache, $state, teacherConsultantService) {
        //set new plain task answers as read
        $scope.readNewPlainTasksAnswers=function(){
            $http({
                method:'POST',
                url:basePath + '/_teacher/_teacher_consultant/teacherConsultant/readNewPlainTasksAnswers',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function(){
                $rootScope.countOfNewPlainTasksAnswers=0;
            }).error(function(){
                console.log("Виникла помилка при спробі відмітити нові відповіді на прості задачі, як переглянуті");
            })
        };
        $scope.readNewPlainTasksAnswers();

        $scope.marks = [{id:'0', title:'не зарах.'}, {id:'1', title:'зарах.'}, {id:'null', title:'не перевірено'}];
        $scope.tasksTableParams = new NgTableParams({filter:{'plainTaskMark.mark':'null'}}, {
            getData: function (params) {
                return teacherConsultantService
                    .plainTasksList(params.url())
                    .$promise
                    .then(function (data) {
                        params.total(data.count);

                        // $jq(".question a span").remove();
                        // $jq(".question a script").remove();

                        setTimeout(function() {
                            MathJax.Hub.Config({
                                tex2jax: {
                                    inlineMath: [['$','$'], ['\\(','\\)']]
                                },
                                "HTML-CSS": {
                                    linebreaks: { automatic: true }
                                },
                                SVG: {
                                    linebreaks: { automatic: true }
                                }
                            });
                            MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
                        });
                        return data.rows;
                    });
            }
        });

        $scope.markTask = function () {
            var id = $jq('#plainTaskId').val();
            var mark = $jq('#mark').val();
            var comment = $jq('[name = comment]').val();
            var userId = $jq('#userId').val();
            teacherConsultantService.setMarkPlainTask({'idPlainTask': id, 'mark': mark, 'comment': comment, 'userId': userId})
                .$promise
                .then(function() {
                    bootbox.alert('Ваша оцінка записана в базу', function () {
                        $templateCache.remove(basePath + "/_teacher/_teacher_consultant/teacherConsultant/showPlainTask/idPlainTask/" + id);
                        $state.go('teacherConsultant/tasks');
                    });
            })
                .catch(function() {
                    bootbox.alert('Помилка, зверніться до адміністратора');
                });
        };

        $scope.setMarkTaskInTable = function (id, mark, userId) {
            bootbox.dialog({
                    title: "Коментар",
                    message: '<div class="panel-body"><div class="row"><form role="form" name="commentMessage"><div class="form-group col-md-12">'+
                    '<textarea class="form-control" style="resize: none" rows="6" id="commentText" ' +
                    'placeholder="тут можна залишити коментар"></textarea>'+
                    '</div></form></div></div>',
                    buttons: {success: {label: "Підтвердити", className: "btn btn-primary",
                        callback: function () {
                            var comment = $jq('#commentText').val();
                            teacherConsultantService.setMarkPlainTask({'idPlainTask': id, 'mark': mark, 'comment': comment, 'userId': userId}).$promise.then(function(){
                                $scope.tasksTableParams.reload();
                            });
                        }
                    },
                        cancel: {label: "Скасувати", className: "btn btn-default",
                            callback: function () {
                            }
                        }
                    }
                }
            );
        }

    })
    .controller('teacherConsultantCtrl', function ($scope, typeAhead, $http, $state,$templateCache,$stateParams) {
        $templateCache.remove(basePath + "/_teacher/_trainer/trainer/editTeacherModule/id/"+$stateParams.studentId+"/idModule/" + $stateParams.idModule);
        $scope.changePageHeader('Призначення студенту викладача');
        var teachersTypeaheadUrl = basePath+ '/_teacher/_trainer/trainer/teacherConsultantsByQuery';
        $scope.selectedTeacher = null;
        $scope.consultantSelected = null;
        $scope.getTeachers = function(value,module){
            return typeAhead.getData(teachersTypeaheadUrl,{query:value, module:module})
        };
        $scope.onSelect = function ($item) {
            $scope.selectedTeacher = $item;
        };

        $scope.onConsultantSelect = function ($item) {
            $scope.consultantSelected = $item;
            console.log($item);
        };

        $scope.assignTeacher = function (studentId,moduleId) {
            if ($scope.selectedTeacher)
            $http({
                method:'POST',
                url:basePath + '/_teacher/_trainer/trainer/assignTeacherForStudent',
                data: $jq.param({teacher: $scope.selectedTeacher.id, module: moduleId, student: studentId}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function(response){
                bootbox.alert(response,function(){
                    $templateCache.remove(basePath + "/_teacher/_trainer/trainer/viewStudent/id/" + studentId);
                    $state.go('trainer/viewStudent/:studentId',{studentId:studentId},{reload:true})
                });
            }).error(function(){
                bootbox.alert("Викладачу не вдалося призначити обраний модуль. Спробуйте повторити " +
                "операцію пізніше або напишіть на адресу " + adminEmail)
            })

        };
        $scope.cancelTeacher = function(teacherId, moduleId, studentId){
            $http({
                method:'POST',
                url: basePath+'/_teacher/_trainer/trainer/cancelTeacherForStudent',
                data: $jq.param({teacher: teacherId, module: moduleId, student: studentId}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (response){
                bootbox.alert(response,function(){
                    $templateCache.remove(basePath + "/_teacher/_trainer/trainer/viewStudent/id/" + studentId);
                    $state.go('trainer/viewStudent/:studentId',{studentId:studentId},{reload:true})
                });
            }).error(function(){
                bootbox.alert("Операцію не вдалося виконати. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу " + adminEmail);
            });
        };
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
                    return $resource(basePath + '/_teacher/_teacher_consultant/teacherConsultant/getTodayConsultationsList').get(params.url()).$promise.then(function (data) {
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
                    return $resource(basePath+'/_teacher/_teacher_consultant/teacherConsultant/getPastConsultationsList').get(params.url()).$promise.then(function (data) {
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
                    return $resource(basePath+'/_teacher/_teacher_consultant/teacherConsultant/getCancelConsultationsList').get(params.url()).$promise.then(function (data) {
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
                    return $resource(basePath+'/_teacher/_teacher_consultant/teacherConsultant/getPlannedConsultationsList').get(params.url()).$promise.then(function (data) {
                        params.total(data.count);
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
                        url:basePath+'/_teacher/_teacher_consultant/teacherConsultant/cancelConsultation?id='+consultationId,
                    }).success(function(response){
                        if (response==='success'){
                            $state.go('teacherConsultant/consultations');
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
    })
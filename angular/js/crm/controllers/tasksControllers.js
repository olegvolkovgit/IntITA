/**
 * Created by adm on 19.07.2016.
 */

angular
    .module('crmApp')
    .controller('crmTasksCtrl', ['$scope', 'ModalService', 'crmTaskServices','ngToast','$rootScope','NgTableParams','$state','lodash','$filter',
        function ($scope, ModalService, crmTaskServices, ngToast, $rootScope, NgTableParams,$state, lodash, $filter) {
            $scope.changePageHeader('Завдання');

            $scope.board=1;
            $scope.currentUser=user;

            $scope.openNewModal = function (id) {
                ModalService.Open(id);
            };
            $scope.openModal = function (id) {
                ModalService.Open(id);
            };
            $scope.closeModal = function (id) {
                $scope.initCrmTask();
                ModalService.Close(id);
            };

            $scope.tabs = [
                { title: "Мої", route: "executant"},
                { title: "Допомагаю", route: "collaborator"},
                { title: "Доручив", route: "producer"},
                { title: "Спостерігаю", route: "observer"},
                { title: "Усі", route: "all"},
            ];

            crmTaskServices
                .activeCrmTasksCount()
                .$promise
                .then(function (data) {
                    $scope.rolesCount=data;
                    $scope.tabs.forEach(function(item, i) {
                        if(lodash.find($scope.rolesCount, ['role', item.route])){
                            item.count=lodash.find($scope.rolesCount, ['role', item.route]).count;
                        }
                        if('tasks.'+item.route==$state.current.name) {
                            $scope.active=i;
                        }
                    });
                });

            $scope.editorOptionsCrm = {toolbar: 'main'};
            $scope.initCrmTask=function () {
                $scope.crmTask = { name:null,body:null,startTask:null,endTask:null, deadline:null,
                    roles:{collaborator:null, executant:null, observer:null, producer:null
                    }
                };
            };
            $scope.initCrmTask();

            $scope.sendTask = function (task, id) {
                $scope.isDisabled=true;
                crmTaskServices.sendCrmTask({crmTask: angular.toJson(task)}).$promise
                    .then(function (data) {
                        if (data.message === 'OK') {
                            $scope.closeModal(id);
                            $scope.initCrmTask();
                            ngToast.create({
                                dismissOnTimeout: true,
                                dismissButton: true,
                                className: 'success',
                                content: 'Завдання успішно додано'
                            });
                            $scope.loadTasks($rootScope.roleId);
                        } else {
                            bootbox.alert(data.reason);
                        }
                        $scope.isDisabled=false;
                    })
                    .catch(function (error) {
                        $scope.isDisabled=false;
                        bootbox.alert(JSON.parse(error.data.reason));
                    });
            };

            $scope.getTask = function (id,modalId, isDragging) {
                if(!isDragging){
                    crmTaskServices.getCrmTask({id:id}).$promise
                        .then(function (data) {
                            $scope.openModal(modalId);
                            $scope.crmTask=data.task;
                            $scope.crmTask.startTask=$scope.crmTask.startTask?new Date($scope.crmTask.startTask) : null;
                            $scope.crmTask.endTask=$scope.crmTask.endTask?new Date($scope.crmTask.endTask) : null;
                            $scope.crmTask.deadline=$scope.crmTask.deadline?new Date($scope.crmTask.deadline) : null;
                            $scope.crmTask.roles=data.roles;
                            $scope.crmTask.editMode=false;
                            $scope.producer=data.roles.producer.name;
                        })
                        .catch(function (error) {
                            bootbox.alert(JSON.parse(error.data.reason));
                        });
                }
            }

            $scope.loadTasks=function (idRole) {

                if($scope.board==1){
                    return $scope.loadKanbanTasks(idRole);
                }else{
                    var promise = $scope.tasksTableParams = new NgTableParams({
                        sorting: {
                            assigned_date: 'desc'
                        },
                        id:idRole}, {
                        getData: function (params) {
                            return crmTaskServices
                                .getTasks(params.url())
                                .$promise
                                .then(function (data) {
                                    params.total(data.count);
                                    return data.rows;
                                });
                        }
                    });
                    return promise;
                }
            };

            $scope.crmStateList = crmTaskServices
                .crmStateList()
                .$promise
                .then(function (data) {
                    return $scope.crmStates=data.map(function (item) {
                        return {id: item.id, title: item.description}
                    });
                });

            $scope.loadKanbanTasks=function (idRole) {
                var promise = $scope.crmCanbanTasksList =
                    crmTaskServices
                        .getTasks({id:idRole})
                        .$promise
                        .then(function (data) {
                            $scope.crmCards=data.rows.map(function (item) {
                                return {
                                    id: item.idTask.id,
                                    title: item.idTask.name,
                                    producerName: item.producerName.fullName,
                                    producerAvatar: basePath+'/images/avatars/'+item.producerName.avatar,
                                    description:$filter('limitTo')(item.idTask.body, 100),
                                    changeDate:item.idTask.change_date,
                                    status: "concept",
                                    type: "task",
                                    stage_id:item.idTask.id_state
                                }
                            });
                            $scope.initCrmKanban($scope.crmCards);

                            return true;
                        });
                return promise;
            };

            $scope.$watch('board', function () {
                $scope.loadTasks($rootScope.roleId);
            });

            $scope.getKanban = function () {
                return basePath+'/angular/js/crm/templates/crmKanban.html';
            };

            $scope.bugs = ['expect_to_execute', 'executed', 'paused', 'completed'];

            $scope.initCrmKanban=function (crmCards) {
                // object for stages
                $scope.stages =
                    [
                        {"id": 1, "name": "Очікує на виконання"},
                        {"id": 2, "name": "Виконується"},
                        {"id": 3, "name": "Призупинено"},
                        {"id": 4, "name": "Завершено"},
                    ];
                // object for tasks
                $scope.tasks =crmCards;
            };

            // function for drag start
            $scope.dragStart = function dragStart(event, task){
                task.dragging = true;
            }

            // function for on dropping
            $scope.onDrop = function onDrop(data,event,stage){
                if(data && data.stage_id != stage.id && $rootScope.roleId!=4 && $rootScope.roleId!=0){
                    crmTaskServices.changeTaskState({id:data.id, state:stage.id}).$promise.then(function(){
                        $scope.loadKanbanTasks($rootScope.roleId);
                    });
                }
                if(data) data.dragging = false;
            }

        }])
    .controller('crmMyTasksCtrl', ['$scope', '$rootScope',
        function ($scope, $rootScope) {
            $scope.changePageHeader('Мої завдання');
            $rootScope.roleId=1;
            $scope.loadTasks($rootScope.roleId);
    }])
    .controller('crmEntrustTasksCtrl',  ['$scope', '$rootScope',
        function ($scope, $rootScope) {
            $scope.changePageHeader('Завдання які доручив');
            $rootScope.roleId=2;
            $scope.loadTasks($rootScope.roleId);
        }])
    .controller('crmWatchTasksCtrl',  ['$scope', '$rootScope',
        function ($scope, $rootScope) {
            $scope.changePageHeader('Завдання в яких спостерігаю');
            $rootScope.roleId=4;
            $scope.loadTasks($rootScope.roleId);
        }])
    .controller('crmHelpsTasksCtrl',  ['$scope', '$rootScope',
        function ($scope, $rootScope) {
            $scope.changePageHeader('Завдання в яких допомагаю');
            $rootScope.roleId=3;
            $scope.loadTasks($rootScope.roleId);
        }])
    .controller('crmAllTasksCtrl',  ['$scope', '$rootScope',
        function ($scope, $rootScope) {
            $scope.changePageHeader('Усі завдання зі мною');
            $rootScope.roleId=0;
            $scope.loadTasks($rootScope.roleId);
        }])
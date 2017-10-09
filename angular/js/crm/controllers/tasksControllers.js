/**
 * Created by adm on 19.07.2016.
 */

angular
    .module('crmApp')
    .controller('crmTasksCtrl', ['$attrs','$scope', 'crmTaskServices','ngToast','$rootScope','NgTableParams','$state','lodash','$filter','$uibModal','$timeout','$window',
        function ($attrs,$scope, crmTaskServices, ngToast, $rootScope, NgTableParams,$state, lodash, $filter, $uibModal,$timeout,$window) {
            $scope.changePageHeader('Завдання');

            $rootScope.teacherMode=$attrs.teachermode1;
            var conn = new ab.Session('wss://'+window.location.host+'/wss/',
                function() {
                    conn.subscribe('changeTask-'+user, function(topic, data) {
                        console.log('Task changed');
                        $rootScope.loadTasks($rootScope.roleId);
                        $rootScope.updateTaskManagerCounter();
                    });
                },
                function() {
                    console.warn('WebSocket connection closed');
                },
                {'skipSubprotocolCheck': true}
            );

            $scope.currentDate = currentDate;
            $scope.board=1;
            $scope.currentUser=user;
            $scope.canEditCrmTasks=canEditCrmTasks;

            $scope.openModal = function (size, parentSelector) {
                var parentElem = parentSelector ?
                    angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
                $rootScope.modalInstance = $uibModal.open({
                    animation: true,
                    ariaLabelledBy: 'modal-title',
                    ariaDescribedBy: 'modal-body',
                    templateUrl: 'crmModalContent.html',
                    scope:$scope,
                    size: size,
                    appendTo: parentElem,
                });

                $rootScope.modalInstance.result.then(function (selectedItem) {
                    $scope.selected = selectedItem;
                }, function () {
                    console.log('Modal dismissed at: ' + new Date());
                });
            };

            $scope.closeModal = function () {
                $scope.initCrmTask();
                $rootScope.modalInstance.close();
            };

            $scope.tabs = [
                { title: "Мої", route: "executant"},
                { title: "Допомагаю", route: "collaborator"},
                { title: "Доручив", route: "producer"},
                { title: "Спостерігаю", route: "observer"},
                { title: "Усі", route: "all"},
            ];

            $rootScope.getTasksCount=function () {
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
            };
            $rootScope.getTasksCount();

            $scope.editorOptionsCrm = {toolbar: 'main'};
            $rootScope.initCrmTask=function () {
                $scope.crmTask = { name:null,body:null,startTask:null,endTask:null, deadline:null,
                    roles:{collaborator:null, executant:null, observer:null, producer:null
                    }
                };
            };
            $scope.initCrmTask();

            $scope.sendTask = function (task) {
                if (task.isModelValid()){
                    $scope.isDisabled = true;
                    crmTaskServices.sendCrmTask({crmTask: angular.toJson(task)}).$promise
                        .then(function (data) {
                            if (data.message === 'OK') {
                                $scope.closeModal();
                                $scope.initCrmTask();
                                ngToast.create({
                                    dismissOnTimeout: true,
                                    dismissButton: true,
                                    className: 'success',
                                    content: 'Завдання успішно додано'
                                });
                                $rootScope.loadTasks($rootScope.roleId);
                            } else {
                                bootbox.alert(data.reason);
                            }
                            $scope.isDisabled = false;
                        })
                        .catch(function (error) {
                            $scope.isDisabled = false;
                            bootbox.alert(JSON.parse(error.data.reason));
                        });
                }
                return false;
            };

            $scope.getTask = function (id, isDragging) {
                if(!isDragging){
                    crmTaskServices.getCrmTask({id:id}).$promise
                        .then(function (data) {
                            $scope.openModal('lg');
                            $scope.crmTask=data.task;
                            $scope.crmTask.startTask=$scope.crmTask.startTask?new Date($scope.crmTask.startTask) : null;
                            $scope.crmTask.endTask=$scope.crmTask.endTask?new Date($scope.crmTask.endTask) : null;
                            $scope.crmTask.deadline=$scope.crmTask.deadline?new Date($scope.crmTask.deadline) : null;
                            $scope.crmTask.roles=data.roles;
                            $scope.crmTask.editMode=false;
                            $scope.crmTask.producer=data.roles.producer.name;
                            $scope.crmTask.executant=data.roles.executant.name;
                        })
                        .catch(function (error) {
                            bootbox.alert(JSON.parse(error.data.reason));
                        });
                }
            }

            $rootScope.loadTasks=function (idRole) {
                if($scope.board==1){
                    return $scope.loadKanbanTasks(idRole).then(function (data) {
                        $scope.setKanbanHeight();
                    });
                }else{
                    return $scope.loadTableTasks(idRole);
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
            $scope.crmPrioritiesList=[
                {id:"1",title:'Низький'},
                {id:"2",title:'Середній'},
                {id:"3",title:'Високий'},
                {id:"4",title:'Терміновий'},
            ];

            $scope.loadTableTasks=function (idRole) {
                var promise = $scope.tasksTableParams = new NgTableParams({
                    sorting: {
                        'idTask.priority': 'desc',
                        // assigned_date: 'desc',
                    },
                    id: idRole
                }, {
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
            };

            $scope.loadKanbanTasks=function (idRole) {
                var promise = $scope.crmCanbanTasksList =
                    crmTaskServices
                        .getTasks({'sorting[idTask.priority]':'desc',id:idRole,})
                        .$promise
                        .then(function (data) {
                            $scope.crmCards=data.rows.map(function (item) {
                                return {
                                    id: item.idTask.id,
                                    title: item.idTask.name,
                                    producerName: item.producerName.fullName,
                                    producerAvatar: basePath+'/images/avatars/'+item.producerName.avatar,
                                    executantName: item.executantName.fullName,
                                    executantAvatar: basePath+'/images/avatars/'+item.executantName.avatar,
                                    description:$filter('limitTo')(item.idTask.body, 70),
                                    changeDate:item.idTask.change_date,
                                    status: "concept",
                                    type: "task",
                                    stage_id:item.idTask.id_state,
                                    lastChangeBy:item.lastChangeName?item.lastChangeName.fullName:'',
                                    lastChangeByAvatar: item.lastChangeName?basePath+'/images/avatars/'+item.lastChangeName.avatar:'',
                                    lastChangeDate:item.lastChangeName?item.lastStateHistory[0].change_date:'',
                                    spent_time:item.spent_time,
                                    endTask:item.idTask.endTask,
                                    deadline:item.idTask.deadline,
                                    createdBy:item.idTask.created_by,
                                    priorityTitle:item.idTask.priorityModel.title,
                                    priority:item.idTask.priorityModel.description
                                }
                            });

                            $scope.initCrmKanban($scope.crmCards);

                            $timeout(function() {
                                $scope.setKanbanHeight()
                            }, 3000);

                            return true;
                        });
                return promise;
            };

            $scope.setKanbanHeight = function (){
                var heights = angular.element(".kanban-column").map(function () {
                    return angular.element(this).height();
                }).get(), maxHeight = Math.max.apply(null, heights);
                if($window.innerWidth>800) {
                    $scope.kanbanHeight = {'min-height': maxHeight};
                }
            };

            $scope.$watch('board', function () {
                if(typeof $rootScope.roleId!='undefined') $rootScope.loadTasks($rootScope.roleId);
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
                if(data && data.stage_id != stage.id){
                    crmTaskServices.changeTaskState({id:data.id, state:stage.id}).$promise.then(function(){
                        $scope.loadKanbanTasks($rootScope.roleId);
                        $scope.setKanbanHeight();
                    });
                }
                if(data) data.dragging = false;
            }
            $scope.changeKanbanState =  function (task, state) {
                crmTaskServices.changeTaskState({id:task.id, state:state}).$promise.then(function(){
                    if($scope.board==1) {
                        $scope.loadKanbanTasks($rootScope.roleId);
                        $scope.setKanbanHeight();
                    }else{
                        $scope.loadTableTasks($rootScope.roleId)
                        $scope.tasksTableParams.reload();
                    }
                });
            }

            $scope.cancelKanbanCrmTask = function (task) {
                bootbox.confirm('Ти впевнений, що хочеш видалити завдання?', function (result) {
                    if (result) {
                        crmTaskServices.cancelCrmTask({id: task.id}).$promise
                            .then(function (data) {
                                if ($scope.board == 1) {
                                    $scope.loadKanbanTasks($rootScope.roleId);
                                    $scope.setKanbanHeight();
                                } else {
                                    $scope.loadTableTasks($rootScope.roleId)
                                    $scope.tasksTableParams.reload();
                                }
                            });
                    }
                });
            };
            $scope.scrollTo = function (cl) {
                $jq('html, body').animate({
                    scrollTop: $jq( '.' + cl).offset().top
                }, 'slow');
            };
        }])
    .controller('crmMyTasksCtrl', ['$scope', '$rootScope',
        function ($scope, $rootScope) {
            $scope.changePageHeader('Мої завдання');
            $rootScope.roleId=1;
            $rootScope.loadTasks($rootScope.roleId);
    }])
    .controller('crmEntrustTasksCtrl',  ['$scope', '$rootScope',
        function ($scope, $rootScope) {
            $scope.changePageHeader('Завдання які доручив');
            $rootScope.roleId=2;
            $rootScope.loadTasks($rootScope.roleId);
        }])
    .controller('crmWatchTasksCtrl',  ['$scope', '$rootScope',
        function ($scope, $rootScope) {
            $scope.changePageHeader('Завдання в яких спостерігаю');
            $rootScope.roleId=4;
            $rootScope.loadTasks($rootScope.roleId);
        }])
    .controller('crmHelpsTasksCtrl',  ['$scope', '$rootScope',
        function ($scope, $rootScope) {
            $scope.changePageHeader('Завдання в яких допомагаю');
            $rootScope.roleId=3;
            $rootScope.loadTasks($rootScope.roleId);
        }])
    .controller('crmAllTasksCtrl',  ['$scope', '$rootScope',
        function ($scope, $rootScope) {
            $scope.changePageHeader('Усі завдання зі мною');
            $rootScope.roleId=0;
            $rootScope.loadTasks($rootScope.roleId);
        }])
    .controller('crmManagerCtrl',  ['$scope', 'crmTaskServices',
        function ($scope, crmTaskServices) {
            $scope.changePageHeader('Менеджер завдань');

            $scope.visitedTasksManager=function () {
                crmTaskServices
                    .visitedTasksManager()
                    .$promise
                    .then(function (data) {
                    });
            };

            $scope.getTasksManager=function () {
                crmTaskServices
                    .tasksManagerList()
                    .$promise
                    .then(function (data) {
                        $scope.tasks=data;
                        $scope.newTaskEvents=$scope.taskManagerCount;
                        $scope.visitedTasksManager();
                    });
            };

            $scope.getTasksManager();
        }]);
/**
 * Created by adm on 19.07.2016.
 */

angular
    .module('crmApp')
    .controller('crmTasksCtrl', ['$scope', 'ModalService', 'crmTaskServices','ngToast','$rootScope','NgTableParams','$state','lodash',
        function ($scope, ModalService, crmTaskServices, ngToast, $rootScope, NgTableParams,$state, lodash) {
            $scope.changePageHeader('Завдання');

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

            $scope.getTask = function (id,modalId) {
                crmTaskServices.getCrmTask({id:id}).$promise
                    .then(function (data) {
                        $scope.openModal(modalId);
                        $scope.crmTask=data.task;
                        $scope.crmTask.startTask=$scope.crmTask.startTask?new Date($scope.crmTask.startTask) : null;
                        $scope.crmTask.endTask=$scope.crmTask.endTask?new Date($scope.crmTask.endTask) : null;
                        $scope.crmTask.deadline=$scope.crmTask.deadline?new Date($scope.crmTask.deadline) : null;
                        $scope.crmTask.roles=data.roles;
                        $scope.producer=data.roles.producer.name;
                    })
                    .catch(function (error) {
                        bootbox.alert(JSON.parse(error.data.reason));
                    });
            }

            $scope.loadTasks=function (idRole) {
                $scope.tasksTableParams = new NgTableParams({
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
            };

            $scope.crmStateList = crmTaskServices
                .crmStateList()
                .$promise
                .then(function (data) {
                    return $scope.crmStates=data.map(function (item) {
                        return {id: item.id, title: item.description}
                    });
                });
        }])
    .controller('crmMyTasksCtrl', ['$scope', 'crmTaskServices','ngToast','$rootScope',
        function ($scope, crmTaskServices, ngToast,$rootScope) {
            $scope.changePageHeader('Мої завдання');
            $rootScope.roleId=1;
            $scope.loadTasks($rootScope.roleId);
    }])
    .controller('crmEntrustTasksCtrl', ['$scope', 'crmTaskServices','ngToast','$rootScope',
        function ($scope, crmTaskServices, ngToast,$rootScope) {
            $scope.changePageHeader('Завдання які доручив');
            $rootScope.roleId=2;
            $scope.loadTasks($rootScope.roleId);
        }])
    .controller('crmWatchTasksCtrl', ['$scope', 'crmTaskServices','ngToast','$rootScope',
        function ($scope, crmTaskServices, ngToast,$rootScope) {
            $scope.changePageHeader('Завдання в яких спостерігаю');
            $rootScope.roleId=4;
            $scope.loadTasks($rootScope.roleId);
        }])
    .controller('crmHelpsTasksCtrl', ['$scope', 'crmTaskServices','ngToast','$rootScope',
        function ($scope, crmTaskServices, ngToast,$rootScope) {
            $scope.changePageHeader('Завдання в яких допомагаю');
            $rootScope.roleId=3;
            $scope.loadTasks($rootScope.roleId);
        }])
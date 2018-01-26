/**
 * Created by adm on 19.07.2016.
 */
angular
    .module('teacherApp')
    .controller('taskTypesTableCtrl', ['$scope', 'careerService', '$state','taskTypeService',
        function ($scope, careerService, $state, taskTypeService) {
            $scope.changePageHeader("Типи завдань Таск-Менеджера");

            $scope.loadTaskTypes=function(){
                return taskTypeService
                    .crmTasksTypeList()
                    .$promise
                    .then(function (data) {
                        $scope.taskTypes=data;
                        $scope.model = [generateList()];
                        $scope.onDrop = function(srcList, srcIndex, targetList, targetIndex) {
                            targetList.splice(targetIndex, 0, srcList[srcIndex]);
                            if (srcList == targetList && targetIndex <= srcIndex) srcIndex++;
                            srcList.splice(srcIndex, 1);

                            var newList = [];
                            for(var i=0; i<targetList.length;i++){
                                newList.push(targetList[i].labelFunc(i)[1]);
                            }
                            $scope.changeTypeOrder(newList);
                            return true;
                        };
                        function generateList() {
                            return data.map(function(letter) {
                                return {
                                    labelFunc: function(index) {
                                        letter.order=index+1;
                                        return [index+1,letter];
                                    }
                                };
                            });
                        }
                    });
            };
            $scope.loadTaskTypes();

            $scope.createTaskType= function () {
                taskTypeService.createTaskType({data: angular.toJson($scope.taskType)}).$promise
                    .then(function successCallback() {
                        $state.go("configuration/task_types", {}, {reload: true});
                    }, function errorCallback() {
                        bootbox.alert("Створити тип завдання не вдалося. Помилка сервера.");
                    });
            };
            $scope.changeTypeOrder= function (data) {
                $scope.modelAsJson = angular.toJson(data, true);
                taskTypeService.reorderTaskType({data:$scope.modelAsJson}).$promise
                    .then(function successCallback() {
                        $scope.loadTaskTypes()
                    }, function errorCallback() {
                        bootbox.alert("Помилка сервера.");
                    });
            };
        }])
    .controller('taskTypeCtrl', ['$scope', '$state', '$stateParams','taskTypeService',
        function ($scope, $state, $stateParams, taskTypeService) {
            $scope.changePageHeader("Тип завдання");

            $scope.loadTaskData=function(){
                taskTypeService
                    .crmTaskType({id:$stateParams.id})
                    .$promise
                    .then(function successCallback(response) {
                        $scope.taskType=response;
                    }, function errorCallback() {
                        bootbox.alert("Отримати дані типу завдання не вдалося");
                    });
            };
            $scope.loadTaskData();

            $scope.editTaskType= function () {
                taskTypeService
                    .updateTaskType({data: angular.toJson($scope.taskType)})
                    .$promise
                    .then(function successCallback(response) {
                        $state.go("configuration/task_types", {}, {reload: true});
                    }, function errorCallback() {
                        bootbox.alert("Відредагувати тип завдання не вдалося. Помилка сервера.");
                    });
            };
        }])
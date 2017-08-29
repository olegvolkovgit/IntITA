'use strict';

/* App Module */
// dependence on ngCkeditor
angular
    .module('crmApp')
    .directive('crmTask', ['$resource', 'typeAhead','crmTaskServices','NgTableParams','$rootScope','$compile',
        function ($resource, typeAhead, crmTaskServices,NgTableParams,$rootScope,$compile) {
            function link(scope, element, attrs) {

                //***init block***
                scope.currentUser=user;
                scope.category = {name: 'coworkers'}; //default users category
                scope.inputs = {};// roles inputs obj
                scope.newComment=false;
                scope.comment={
                    id_task:null,
                    message:null,
                };
                // datepickers options
                scope.dateOptionsDeadline = new DateOptions();
                scope.dateOptionsStart = new DateOptions();
                scope.dateOptionsEnd = new DateOptions();
                function DateOptions() {
                    this.popupOpened = false;
                    this.maxDate = new Date(2020, 5, 22);
                    this.minDate = new Date();
                    this.startingDay = 1;
                }
                DateOptions.prototype.open = function () {
                    this.popupOpened = true;
                };
                // init crm roles from DB
                crmTaskServices.getCrmRoles().$promise.then(function(response){
                    scope.roles = response;
                });
                //***init block***

                scope.getUsersForCategory = function (query, category, multiple) {
                    return crmTaskServices.getUsersByCategory({query: query, category: category, multiple: multiple}).$promise.then(function(response){
                        return response;
                    });
                };

                // functions for typeahead
                scope.onSelectUser = function ($item) {
                    scope.task.roles.producer = $item;
                };

                scope.reloadUser = function () {
                    scope.task.roles.producer = null;
                };

                scope.rolesVisibility = function (role) {
                    if(scope.task.roles[role]) scope.inputs[role]=true;
                    scope.inputs[role] = !scope.inputs[role];
                    if (!scope.inputs[role]) {
                        scope.task.roles[role] = null;
                        if(role=='producer'){
                            scope.producer=null;
                        }
                    }
                }

                scope.getTaskInDirective = function (id) {
                    crmTaskServices.getCrmTask({id:id}).$promise
                        .then(function (data) {
                            scope.task=data.task;
                            scope.task.startTask=scope.task.startTask?new Date(scope.task.startTask) : null;
                            scope.task.endTask=scope.task.endTask?new Date(scope.task.endTask) : null;
                            scope.task.deadline=scope.task.deadline?new Date(scope.task.deadline) : null;
                            scope.task.roles=data.roles;
                            scope.producer=data.roles.producer.name;
                            scope.loadTasksHistory(scope.task.id);
                        })
                        .catch(function (error) {
                            bootbox.alert(JSON.parse(error.data.reason));
                        });
                }

                scope.changeState = function (task, state) {
                    crmTaskServices.changeTaskState({id:task.id, state:state}).$promise.then(function(){
                        scope.getTaskInDirective(task.id);
                        scope.historyTableParams.reload({id:task.id});
                        scope.someCtrlFn({tasksType: $rootScope.roleId});
                    });
                }

                scope.loadTasksHistory=function (id) {
                    scope.historyTableParams = new NgTableParams({
                        sorting: {
                            change_date: 'desc'
                        },
                        id:id
                    }, {
                        getData: function (params) {
                            return crmTaskServices
                                .getTasksHistory(params.url())
                                .$promise
                                .then(function (data) {
                                    params.total(data.count);
                                    return data.rows;
                                });
                        }
                    });
                }

                scope.loadTasksComments=function (id) {
                    scope.commentsTableParams = new NgTableParams({
                        sorting: {
                            create_date: 'desc'
                        },
                        id:id
                    }, {
                        getData: function (params) {
                            return crmTaskServices
                                .getTaskComments(params.url())
                                .$promise
                                .then(function (data) {
                                    params.total(data.count);
                                    return data.rows;
                                });
                        }
                    });
                }

                scope.$watch('task.id', function (newValue, oldValue) {
                    if (newValue != oldValue) {
                        scope.loadTasksHistory(newValue);
                        scope.loadTasksComments(newValue);
                    }
                });

                scope.initTask=function () {
                    scope.task = {
                        id:null, name:null,body:null,startTask:null,endTask:null, deadline:null,
                        roles:{ collaborator:null, executant:null, observer:null, producer:null }
                    };
                };

                scope.cleanTask = function () {
                    scope.initTask();
                };

                scope.toggleComment=function () {
                    scope.newComment=!scope.newComment;
                    scope.comment.message=null;
                }
                scope.addComment = function (comment) {
                    scope.comment.id_task=scope.task.id;
                    scope.isDisabledComment=true;
                    crmTaskServices.addCrmTaskComment({comment:comment}).$promise
                        .then(function (data) {
                            scope.newComment=false;
                            scope.loadTasksComments(scope.task.id);
                            scope.isDisabledComment=false;
                        })
                        .catch(function (error) {
                            scope.isDisabledComment=false;
                            bootbox.alert(JSON.parse(error.data.reason));
                        });
                };

                scope.removeComment = function (commentId) {
                    bootbox.confirm('Видалити коментар?', function (result) {
                        if (result) {
                            crmTaskServices.removeCrmTaskComment({commentId:commentId}).$promise
                                .then(function (data) {
                                    scope.loadTasksComments(scope.task.id);
                                })
                                .catch(function (error) {
                                    bootbox.alert('Операцію не вдалося виконати');
                                });
                        }
                    });
                };

                scope.editComment=function(event, commentId, oldComment){
                    scope.commentMessage=oldComment;
                    var template = '<textarea ng-cloak ckeditor="ckeditorOptions" ng-model="commentMessage" required></textarea><br>'
                    bootbox.dialog({
                            title: "Редагувати коментар",
                            message: ($compile(template)(scope)),
                            buttons: {success: {label: "Підтвердити", className: "btn btn-primary",
                                callback: function () {
                                    scope.isDisabledComment=true;
                                    crmTaskServices.editCrmTaskComment({commentId:commentId, comment:scope.commentMessage}).$promise
                                        .then(function (data) {
                                            scope.newComment=false;
                                            scope.loadTasksComments(scope.task.id);
                                            scope.isDisabledComment=false;
                                        })
                                        .catch(function (error) {
                                            scope.isDisabledComment=false;
                                            bootbox.alert(JSON.parse(error.data.reason));
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
                };

                scope.addComment = function (comment) {
                    scope.comment.id_task=scope.task.id;
                    scope.isDisabledComment=true;
                    crmTaskServices.addCrmTaskComment({comment:comment}).$promise
                        .then(function (data) {
                            scope.newComment=false;
                            scope.loadTasksComments(scope.task.id);
                            scope.isDisabledComment=false;
                        })
                        .catch(function (error) {
                            scope.isDisabledComment=false;
                            bootbox.alert(JSON.parse(error.data.reason));
                        });
                };

            }

            return {
                scope: {
                    'ckeditorOptions': '=ckeditorOptions',
                    "task": "=task",
                    "producer": "=producer",
                    someCtrlFn: '&callbackFn',
                },
                link: link,
                templateUrl: basePath + '/angular/js/crm/templates/task.html'
            };
        }]);
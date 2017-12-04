'use strict';

/* App Module */
// dependence on ngCkeditor
angular
    .module('crmApp')
    .directive('crmTask', ['$resource', 'typeAhead','crmTaskServices','NgTableParams','$rootScope','$compile','$uibModal',
        function ($resource, typeAhead, crmTaskServices,NgTableParams,$rootScope,$compile, $uibModal) {
            function link(scope, element, attrs) {
                scope.teacherMode = $rootScope.teacherMode;

                scope.prioritiesList = function () {
                    scope.task.priorities=[
                        {id:"1",title:'low',description:'Низький'},
                        {id:"2",title:'medium',description:'Середній'},
                        {id:"3",title:'high',description:'Високий'},
                        {id:"4",title:'urgent',description:'Терміновий'},
                    ];
                };
                    scope.weekdaysList=[
                        {id:"1",title:'Понеділок'},
                        {id:"2",title:'Вівторок'},
                        {id:"3",title:'Середа'},
                        {id:"4",title:'Четвер'},
                        {id:"5",title:'П\'ятниця'},
                        {id:"6",title:'Субота'},
                        {id:"7",title:'Неділя'},
                    ];

                scope.notificationUsersList= crmTaskServices.getCrmRoles();

                scope.notificationTemplates = crmTaskServices.getNotificationTemplates();

                scope.prioritiesList();

                if(!scope.task.id){
                    scope.task.priority="2";
                }

                //***init block***
                scope.currentUser=user;
                scope.canEditCrmTasks=canEditCrmTasks;
                if(scope.teacherMode)
                    scope.category = {name: 'coworkers'}; //default users category
                else scope.category = {name: 'students'};
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
                    scope.task.roles.producer = {};
                };

                // functions for typeahead executant
                scope.onSelectExecutant = function ($item) {
                    scope.task.roles.executant = $item;
                };

                scope.reloadExecutant = function () {
                    scope.task.roles.executant = null;
                };

                scope.rolesVisibility = function (role) {
                    if(scope.task.roles[role]) scope.inputs[role]=true;
                    scope.inputs[role] = !scope.inputs[role];
                    if (!scope.inputs[role]) {
                        scope.task.roles[role] = null;
                        if(role=='producer'){
                            scope.producer=null;
                        }
                        if(role=='executant'){
                            scope.executant=null;
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
                            scope.task.producer=data.roles.producer.name;
                            scope.task.executant=data.roles.executant.name;
                            scope.loadTasksHistory(scope.task.id);
                            scope.prioritiesList();
                        })
                        .catch(function (error) {
                            bootbox.alert(JSON.parse(error.data.reason));
                        });
                }

                scope.changeState = function (task, state) {
                    crmTaskServices.changeTaskState({id:task.id, state:state}).$promise.then(function(){
                        scope.getTaskInDirective(task.id);
                        scope.loadTasksHistory(task.id);
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

                scope.loadSpentTimeTask=function (id) {
                    scope.spentTimeTableParams = new NgTableParams({id:id}, {
                        getData: function (params) {
                            return crmTaskServices
                                .getSpentTimeTask(params.url())
                                .$promise
                                .then(function (response) {
                                    return response.data;
                                });
                        }
                    });
                }

                scope.$watch('task.id', function (newValue, oldValue) {
                    scope.loadTasksHistory(newValue);
                    scope.loadTasksComments(newValue);
                    scope.loadSpentTimeTask(newValue);
                });

                scope.cleanTask = function () {
                    scope.task=null;
                    $rootScope.initCrmTask()
                    $rootScope.modalInstance.close();
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

                scope.removeCommentDialog = function (commentId) {
                    scope.commentId=commentId;
                    scope.openCommentDialog = $uibModal.open({
                        animation: true,
                        ariaLabelledBy: 'modal-title',
                        ariaDescribedBy: 'modal-body',
                        templateUrl: basePath + '/angular/js/crm/templates/deleteComment.html',
                        scope: scope,
                        size: 'md',
                        appendTo: false,
                    });
                };

                scope.removeComment = function (commentId) {
                    crmTaskServices.removeCrmTaskComment({commentId:commentId}).$promise
                        .then(function (data) {
                            scope.loadTasksComments(scope.task.id);
                            scope.openCommentDialog.close();
                        })
                        .catch(function (error) {
                            bootbox.alert('Операцію не вдалося виконати');
                        });
                };

                scope.editComment=function(event, commentId, oldComment) {
                    scope.commentMessage = oldComment;
                    scope.commentId = commentId;
                    scope.openCommentDialog = $uibModal.open({
                        animation: true,
                        ariaLabelledBy: 'modal-title',
                        ariaDescribedBy: 'modal-body',
                        templateUrl: basePath + '/angular/js/crm/templates/commentDialog.html',
                        scope: scope,
                        size: 'lg',
                        appendTo: false,
                    });
                };

                scope.updateComment = function (commentId, commentMessage) {
                    scope.isDisabledComment=true;
                    crmTaskServices.editCrmTaskComment({commentId:commentId, comment:commentMessage}).$promise
                        .then(function (data) {
                            scope.newComment=false;
                            scope.loadTasksComments(scope.task.id);
                            scope.isDisabledComment=false;
                            scope.openCommentDialog.close();
                        })
                        .catch(function (error) {
                            scope.isDisabledComment=false;
                            bootbox.alert(JSON.parse(error.data.reason));
                        });
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

                scope.cancelCrmTaskDialog = function (id) {
                    scope.taskId=id;
                    scope.openCommentDialog = $uibModal.open({
                        animation: true,
                        ariaLabelledBy: 'modal-title',
                        ariaDescribedBy: 'modal-body',
                        templateUrl: basePath + '/angular/js/crm/templates/deleteTask.html',
                        scope: scope,
                        size: 'md',
                        appendTo: false,
                    });
                };
                scope.cancelCrmTask = function (id) {
                    crmTaskServices.cancelCrmTask({id:id}).$promise
                        .then(function (data) {
                            scope.getTaskInDirective(id);
                            scope.historyTableParams.reload({id:id});
                            scope.someCtrlFn({tasksType: $rootScope.roleId});
                            $rootScope.modalInstance.close();
                        })
                        .catch(function (error) {
                            bootbox.alert(JSON.parse(error.data.reason));
                        });
                };

                scope.task.isModelValid = function () {
                    if (angular.isDefined(scope.task.notification)) {
                        scope.task.notification.error = [];
                        if (scope.task.notification.notify) {
                            if (!scope.task.notification.users || !scope.task.notification.users.length) {
                                scope.task.notification.error.user = 'Оберіть групу користувачів для оповіщення';
                                return false;
                            }
                            if (!scope.task.notification.template) {
                                scope.task.notification.error.template = 'Оберіть шаблон оповіщення';
                                return false;
                            }
                            if (!scope.task.notification.weekdays || !scope.task.notification.weekdays.length) {
                                scope.task.notification.error.weekdays = 'Оберіть дні для оповіщення';
                                return false;
                            }
                            if (!scope.task.notification.time) {
                                scope.task.notification.error.time = 'Оберіть час для оповіщення';
                                return false;
                            }
                        }
                    }
                    return true;
                }

            }

            return {
                scope: {
                    'ckeditorOptions': '=ckeditorOptions',
                    "task": "=task",
                    someCtrlFn: '&callbackFn',
                },
                link: link,
                templateUrl: basePath + '/angular/js/crm/templates/task.html'
            };
        }]);
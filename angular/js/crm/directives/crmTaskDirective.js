'use strict';

/* App Module */
// dependence on ngCkeditor
angular
    .module('crmApp')
    .directive('crmTask', ['$resource', 'typeAhead', 'crmTaskServices', 'NgTableParams', '$compile', '$uibModal', 'ngToast',
        function ($resource, typeAhead, crmTaskServices, NgTableParams, $compile, $uibModal, ngToast) {
            function link(scope, element, attrs) {
                scope.pathToTemplates=attrs.templatesPath;
                scope.modalMode=attrs.modal== 'true';
                var self=scope.crmTask={
                    options:{},
                    selectedSubTask:'',
                    subTasks:[],
                    checkList:{},
                    priorities: [
                        {id: "1", title: 'low', description: 'Низький'},
                        {id: "2", title: 'medium', description: 'Середній'},
                        {id: "3", title: 'high', description: 'Високий'},
                        {id: "4", title: 'urgent', description: 'Терміновий'},
                    ],
                    weekdaysList: [
                        {id: "1", title: 'Понеділок'},
                        {id: "2", title: 'Вівторок'},
                        {id: "3", title: 'Середа'},
                        {id: "4", title: 'Четвер'},
                        {id: "5", title: 'П\'ятниця'},
                        {id: "6", title: 'Субота'},
                        {id: "7", title: 'Неділя'},
                    ],
                    notificationUsersList: crmTaskServices.getCrmRoles(),
                    notificationTemplates: crmTaskServices.getNotificationTemplates(),
                    data:{
                        priority: "2",
                    },
                    currentUser: scope.currentUser,
                    teacherMode: scope.teacherMode,
                    initTask:function() {
                        return {
                            name:null,body:null,startTask:null,endTask:null, deadline:null,
                            roles: { collaborator:null, executant:null, observer:null, producer:null },
                        }
                    },
                    loadTask: function (id) {
                        if(id){
                            crmTaskServices.getCrmTask({id: id}).$promise
                                .then(function (data) {
                                    self.data=data.task;
                                    self.data.startTask = data.task.startTask ? new Date(data.task.startTask) : null;
                                    self.data.endTask = data.task.endTask ? new Date(data.task.endTask) : null;
                                    self.data.deadline = data.task.deadline ? new Date(data.task.deadline) : null;
                                    self.data.roles = data.roles;
                                    self.data.producer = data.roles.producer.name;
                                    self.data.executant = data.roles.executant.name;
                                    self.loadTasksHistory(id);
                                    self.canEditCrmTasks = scope.rolesCanEditCrmTasks || self.data.created_by==self.currentUser || self.data.roles['producer'].id==self.currentUser;
                                    self.editable = !(self.data.id_state==4 || (self.data.id && !self.canEditCrmTasks))
                                })
                                .catch(function (error) {
                                    bootbox.alert(JSON.parse(error.data.reason));
                                });
                        }else{
                            self.data=self.initTask();
                        }
                    },
                    loadSubTasks: function (id) {
                        if(id){
                            crmTaskServices.getCrmSubTasks({id: id}).$promise
                                .then(function (data) {
                                    self.subTasks=data;
                                })
                                .catch(function (error) {
                                    bootbox.alert(JSON.parse(error.data.reason));
                                });
                        }
                    },
                    loadCheckList: function (id) {
                        if(id){
                            crmTaskServices.getCheckList({id: id}).$promise
                                .then(function (data) {
                                    self.checkList=data;
                                    console.log(self.checkList);
                                })
                                .catch(function (error) {
                                    bootbox.alert(JSON.parse(error.data.reason));
                                });
                        }
                    },
                    createCheckList: function (name, listId) {
                        if(name){
                            crmTaskServices.createCrmCheckList({id_task: self.data.id, name: name, listId: listId}).$promise
                                .then(function (data) {
                                    ngToast.create({
                                        dismissOnTimeout: true,
                                        timeout:2000,
                                        dismissButton: true,
                                        className: 'success',
                                        content: 'Чек-ліст створено'
                                    });
                                    self.options.checkListEditMode=false;
                                })
                                .catch(function (error) {
                                    bootbox.alert(JSON.parse(error.data.reason));
                                });
                        }
                    },
                    addElementToCheckList: function (id) {
                        if(element){
                            crmTaskServices.createCrmCheckListElement({id_list: id, name: self.checkList.newListElement}).$promise
                                .then(function (data) {
                                    self.loadCheckList(self.data.id);
                                })
                                .catch(function (error) {
                                    bootbox.alert(JSON.parse(error.data.reason));
                                });
                        }
                    },
                    updateSubTasks: function (id, subtasks) {
                        if(id){
                            crmTaskServices.updateSubTasks({id: id, subTasks:scope.subTasksMapId(subtasks)}).$promise
                                .then(function (data) {
                                    ngToast.create({
                                        dismissOnTimeout: true,
                                        timeout:2000,
                                        dismissButton: true,
                                        className: 'success',
                                        content: 'Підзадачі оновлено'
                                    });
                                })
                                .catch(function (error) {
                                    ngToast.create({
                                        dismissOnTimeout: true,
                                        timeout:2000,
                                        dismissButton: true,
                                        className: 'warning',
                                        content: 'Підзадачі оновити не вдалося'
                                    });
                                });
                        }
                    },
                    loadTasksHistory:function (id) {
                        scope.historyTableParams = new NgTableParams({
                            sorting: {
                                change_date: 'desc'
                            },
                            id: id
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
                    },
                    loadTasksComments:function (id) {
                        scope.commentsTableParams = new NgTableParams({
                            sorting: {
                                create_date: 'desc'
                            },
                            id: id
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
                        })
                    },
                    loadSpentTimeTask:function (id) {
                        scope.spentTimeTableParams = new NgTableParams({id: id}, {
                            getData: function (params) {
                                return crmTaskServices
                                    .getSpentTimeTask(params.url())
                                    .$promise
                                    .then(function (response) {
                                        return response.data;
                                    });
                            }
                        });
                    },
                    changeState:function (state) {
                        var id=this.data.id;
                        crmTaskServices.changeTaskState({id: id, state: state}).$promise.then(function () {
                            self.loadTask(id);
                            self.loadTasksHistory(id);
                            scope.reloadTaskList({tasksType: scope.roleId});
                        });
                    },
                    addComment:function (comment) {
                        scope.comment.id_task = self.data.id;
                        scope.isDisabledComment = true;
                        crmTaskServices.addCrmTaskComment({comment: comment}).$promise
                            .then(function (data) {
                                scope.newComment = false;
                                self.loadTasksComments(self.data.id);
                                scope.isDisabledComment = false;
                            })
                            .catch(function (error) {
                                scope.isDisabledComment = false;
                                bootbox.alert(JSON.parse(error.data.reason));
                            });
                    },
                    removeCommentDialog: function (commentId) {
                        scope.commentId = commentId;
                        scope.openCommentDialog = $uibModal.open({
                            animation: true,
                            ariaLabelledBy: 'modal-title',
                            ariaDescribedBy: 'modal-body',
                            templateUrl: basePath + '/angular/js/crm/templates/deleteComment.html',
                            scope: scope,
                            size: 'md',
                            appendTo: false,
                        });
                    },
                    removeComment: function (commentId) {
                        crmTaskServices.removeCrmTaskComment({commentId: commentId}).$promise
                            .then(function (data) {
                                self.loadTasksComments(self.data.id);
                                scope.openCommentDialog.close();
                            })
                            .catch(function (error) {
                                bootbox.alert('Операцію не вдалося виконати');
                            });
                    },
                    editComment:function (event, commentId, oldComment) {
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
                    },
                    updateComment: function (commentId, commentMessage) {
                        scope.isDisabledComment = true;
                        crmTaskServices.editCrmTaskComment({commentId: commentId, comment: commentMessage}).$promise
                            .then(function (data) {
                                scope.newComment = false;
                                self.loadTasksComments(self.data.id);
                                scope.isDisabledComment = false;
                                scope.openCommentDialog.close();
                            })
                            .catch(function (error) {
                                scope.isDisabledComment = false;
                                bootbox.alert(JSON.parse(error.data.reason));
                            });
                    },
                    toggleComment: function () {
                        scope.newComment = !scope.newComment;
                        scope.comment.message = null;
                    },
                    cancelCrmTask: function () {
                        crmTaskServices.cancelCrmTask({id: self.data.id}).$promise
                            .then(function (data) {
                                self.loadTask(self.data.id);
                                scope.historyTableParams.reload({id: self.data.id});
                                scope.reloadTaskList({tasksType: scope.roleId});
                                $uibModal.close();
                            })
                            .catch(function (error) {
                                bootbox.alert(JSON.parse(error.data.reason));
                            });
                    },
                    sendTask:function () {
                        if (self.isModelValid()){
                            scope.isDisabled = true;
                            crmTaskServices.sendCrmTask({crmTask: angular.toJson(self.data), subTasks:scope.subTasksMapId(self.subTasks)}).$promise
                                .then(function (data) {
                                    if (data.message === 'OK') {
                                        self.cleanTask();
                                        ngToast.create({
                                            dismissOnTimeout: true,
                                            dismissButton: true,
                                            className: 'success',
                                            content: 'Завдання успішно додано'
                                        });
                                        scope.reloadTaskList({tasksType: scope.roleId});
                                    } else {
                                        bootbox.alert(data.reason);
                                    }
                                    scope.isDisabled = false;
                                })
                                .catch(function (error) {
                                    scope.isDisabled = false;
                                    bootbox.alert(JSON.parse(error.data.reason));
                                });
                        }
                        return false;
                    },
                    updateCrmBody:function () {
                        scope.isDisabled = true;
                        crmTaskServices.updateCrmBody({crmTask: angular.toJson(self.data)}).$promise
                            .then(function (data) {
                                if (data.message === 'OK') {
                                    ngToast.create({
                                        dismissOnTimeout: true,
                                        dismissButton: true,
                                        className: 'success',
                                        timeout:2000,
                                        content: 'Оновлено'
                                    });
                                    scope.reloadTaskList({tasksType: scope.roleId});
                                } else {
                                    bootbox.alert(data.reason);
                                }
                                scope.isDisabled = false;
                            })
                            .catch(function (error) {
                                scope.isDisabled = false;
                                bootbox.alert(JSON.parse(error.data.reason));
                            });
                    },
                    isModelValid: function () {
                        if (angular.isDefined(self.notification)) {
                            self.data.notification.error = [];
                            if (self.data.notification.notify) {
                                if (!self.data.notification.users || !self.notification.users.length) {
                                    self.data.notification.error.user = 'Оберіть групу користувачів для оповіщення';
                                    return false;
                                }
                                if (!self.data.notification.template) {
                                    self.data.notification.error.template = 'Оберіть шаблон оповіщення';
                                    return false;
                                }
                                if (!self.data.notification.weekdays || !self.data.notification.weekdays.length) {
                                    self.data.notification.error.weekdays = 'Оберіть дні для оповіщення';
                                    return false;
                                }
                                if (!self.data.notification.time) {
                                    self.data.notification.error.time = 'Оберіть час для оповіщення';
                                    return false;
                                }
                            }
                        }
                        return true;
                    },
                    cleanTask: function () {
                        if(scope.modalMode){
                            self.data = null;
                            scope.taskId=null;
                            scope.$parent.$close();
                        }
                    },
                };
                self.loadTask(scope.taskId);
                self.loadSubTasks(scope.taskId);
                self.loadCheckList(scope.taskId);

                scope.$watch('crmTask.data.id', function (newValue, oldValue) {
                    self.loadTasksHistory(newValue);
                    self.loadTasksComments(newValue);
                    self.loadSpentTimeTask(newValue);
                });

                //***init block***
                if (self.teacherMode)
                    scope.category = {name: 'coworkers'}; //default users category
                else scope.category = {name: 'students'};
                scope.inputs = {};// roles inputs obj
                scope.newComment = false;
                scope.comment = {
                    id_task: null,
                    message: null,
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
                crmTaskServices.getCrmRoles().$promise.then(function (response) {
                    scope.roles = response;
                });
                //***init block***

                scope.getUsersForCategory = function (query, category, multiple) {
                    return crmTaskServices.getUsersByCategory({
                        query: query,
                        category: category,
                        multiple: multiple
                    }).$promise.then(function (response) {
                        return response;
                    });
                };

                scope.getSubTasks = function (query) {
                    return crmTaskServices.getSubTasks({
                        query: query,
                    }).$promise.then(function (response) {
                        return response;
                    });
                };

                scope.addSubTaskToList= function (task) {
                    var unique=true;
                    $jq.each(self.subTasks, function( key, value ) {
                        if(task.id==value.id){
                            unique=false;
                            return false;
                        }
                    });
                    if(unique){
                        self.subTasks.push(task);
                    }
                    scope.clearSubTaskInput();
                }

                scope.removeSubTaskFromList= function (index) {
                    self.subTasks.splice(index, 1);
                }

                scope.clearSubTaskInput= function () {
                    self.selectedSubTask='';
                    scope.subTaskModel=null;
                }

                // functions for typeahead
                scope.onSelectTask = function ($item) {
                    scope.subTaskModel = $item;
                };

                scope.reloadTask = function () {
                    scope.subTaskModel = null;
                };

                // functions for typeahead
                scope.onSelectUser = function ($item) {
                    self.data.roles.producer = $item;
                };

                scope.reloadUser = function () {
                    self.data.roles.producer = {};
                };

                // functions for typeahead executant
                scope.onSelectExecutant = function ($item) {
                    self.data.roles.executant = $item;
                };

                scope.reloadExecutant = function () {
                    self.data.roles.executant = null;
                };

                scope.rolesVisibility = function (role) {
                    if (self.data.roles[role]) scope.inputs[role] = true;
                    scope.inputs[role] = !scope.inputs[role];
                    if (!scope.inputs[role]) {
                        self.data.roles[role] = null;
                        if (role == 'producer') {
                            scope.producer = null;
                        }
                        if (role == 'executant') {
                            scope.executant = null;
                        }
                    }
                }

                scope.cancelCrmTaskDialog = function (id) {
                    scope.taskId = id;
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

                scope.subTasksMapId = function (subTasks) {
                    var subtasksArr = subTasks.map(function(task) {
                        return task['id'];
                    });

                    return subtasksArr;
                };

                scope.addListElement=function(listId){
                    self.addElementToCheckList(listId);
                    self.checkList.newListElement=null;
                };
            }

            return {
                scope: {
                    'ckeditorOptions': '=ckeditorOptions',
                    'taskId':'=taskId',
                    'currentUser':'=currentUser',
                    'teacherMode':'=teacherMode',
                    'roleId':'=roleId',
                    'rolesCanEditCrmTasks':'=rolesCanEditCrmTasks',
                    reloadTaskList: '&callbackFn',
                },
                link: link,
                templateUrl: basePath + '/angular/js/crm/templates/task.html'
            };
        }]);
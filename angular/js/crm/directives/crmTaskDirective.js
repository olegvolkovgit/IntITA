'use strict';

/* App Module */
// dependence on ngCkeditor
angular
    .module('crmApp')
    .directive('crmTask', ['$resource', 'typeAhead', 'crmTaskServices', 'NgTableParams', '$compile', '$uibModal', 'ngToast','$state','$timeout','$rootScope', 'FileUploader','$ngBootbox',
        function ($resource, typeAhead, crmTaskServices, NgTableParams, $compile, $uibModal, ngToast, $state, $timeout, $rootScope, FileUploader, $ngBootbox) {
            function link(scope, element, attrs) {
                scope.pathToTemplates=attrs.templatesPath;
                scope.pathToFiles=attrs.filesPath;
                scope.modalMode=attrs.modal== 'true';
                var pressedSymbol;

                var self=scope.crmTask={
                    editable:true,
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
                    types: [
                        {id: "1", title: 'Task'},
                        {id: "2", title: 'Bug'},
                        {id: "3", title: 'Feature'},
                        {id: "4", title: 'Support'},
                        {id: "5", title: 'Technical advice'},
                        {id: "6", title: 'Improvement'},
                        {id: "7", title: 'Requirement'},
                        {id: "8", title: 'Test Case'},
                        {id: "9", title: 'Test'},
                        {id: "10", title: 'Event'},
                        {id: "11", title: 'Hometask'},
                        {id: "12", title: 'Consultation'},
                        {id: "13", title: 'Course project'},
                        {id: "14", title: 'Diploma project'},
                        {id: "15", title: 'Interview'},
                        {id: "16", title: 'Assessment'},
                        {id: "17", title: 'Essey'},
                        {id: "18", title: 'CV'},
                        {id: "19", title: 'Motivation letter'},
                        {id: "20", title: 'Rest'},
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
                        type: "1"
                    },
                    currentUser: scope.currentUser,
                    teacherMode: scope.teacherMode,
                    initTask:function() {
                        return {
                            priority: "2",
                            type: "1",
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
                                    self.data.expected_time = Number(data.task.expected_time);
                                    self.data.roles = data.roles;
                                    self.data.producer = data.roles.producer.name;
                                    self.data.executant = data.roles.executant.name;
                                    self.loadTasksHistory(id);
                                    self.canEditCrmTasks = scope.rolesCanEditCrmTasks || self.data.created_by==self.currentUser || self.data.roles['producer'].id==self.currentUser;
                                    self.editable = !(self.data.id_state==4 || (self.data.id && !self.canEditCrmTasks))
                                })
                                .catch(function (error) {
                                    alert(JSON.parse(error.data.reason));
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
                                    alert(JSON.parse(error.data.reason));
                                });
                        }
                    },
                    loadCheckList: function (id) {
                        if(id){
                            crmTaskServices.getCheckList({id: id}).$promise
                                .then(function (data) {
                                    self.checkList=data;
                                })
                                .catch(function (error) {
                                    alert(JSON.parse(error.data.reason));
                                });
                        }
                    },
                    loadTaskDocuments: function (id) {
                        crmTaskServices
                            .getTaskDocuments({id: id})
                            .$promise
                            .then(function (data) {
                                self.taskDocuments = data;
                            });
                    },
                    removeDocumentsFileDialog: function (fileId) {
                        scope.fileId = fileId;
                        scope.openFileDialog = $uibModal.open({
                            animation: true,
                            ariaLabelledBy: 'modal-title',
                            ariaDescribedBy: 'modal-body',
                            templateUrl: basePath + '/angular/js/crm/templates/deleteFileDialog.html',
                            scope: scope,
                            size: 'md',
                            appendTo: false,
                        });
                    },
                    removeDocumentsFile: function (id) {
                        crmTaskServices
                            .removeTaskFile({id: id})
                            .$promise
                            .then(function successCallback() {
                                self.loadTaskDocuments(self.data.id);
                                scope.openFileDialog.close();
                            }, function errorCallback() {
                                alert("Виникла помилка при видалені документу.");
                            });
                    },
                    createCheckList: function (name) {
                        if(name){
                            crmTaskServices.createCrmCheckList({id_task: self.data.id, name: name}).$promise
                                .then(function (response) {
                                    ngToast.create({
                                        dismissOnTimeout: true,
                                        timeout:2000,
                                        dismissButton: true,
                                        className: 'success',
                                        content: 'Чек-ліст оновлено'
                                    });
                                    self.loadCheckList(self.data.id);
                                    self.options.checkListEditMode=false;
                                })
                                .catch(function (error) {
                                    alert(JSON.parse(error.data.reason));
                                });
                        }
                    },
                    removeCheckListDialog: function () {
                        scope.openCheckListDialog = $uibModal.open({
                            animation: true,
                            ariaLabelledBy: 'modal-title',
                            ariaDescribedBy: 'modal-body',
                            templateUrl: basePath + '/angular/js/crm/templates/deleteCheckListDialog.html',
                            scope: scope,
                            size: 'md',
                            appendTo: false,
                        });
                    },
                    removeCheckList: function () {
                        crmTaskServices.removeCrmCheckList({id:self.data.id}).$promise
                            .then(function (response) {
                                ngToast.create({
                                    dismissOnTimeout: true,
                                    timeout:2000,
                                    dismissButton: true,
                                    className: 'success',
                                    content: 'Чек-ліст видалено'
                                });
                                self.loadCheckList(self.data.id);
                                self.options.checkListEditMode=false;
                                scope.openCheckListDialog.close();
                            })
                            .catch(function (error) {
                                alert(JSON.parse(error.data.reason));
                            });
                    },
                    addElementToCheckList: function (id) {
                        if(element){
                            crmTaskServices.createCrmCheckListElement({id_list: id, name: self.checkList.newListElement}).$promise
                                .then(function (data) {
                                    self.loadCheckList(self.data.id);
                                })
                                .catch(function (error) {
                                    alert(JSON.parse(error.data.reason));
                                });
                        }
                    },
                    updateCheckListElement: function (id, name) {
                        if(name){
                            crmTaskServices.updateCrmCheckListElement({id: id, name: name}).$promise
                                .then(function (data) {
                                    self.loadCheckList(self.data.id);
                                })
                                .catch(function (error) {
                                    alert(JSON.parse(error.data.reason));
                                });
                        }
                    },
                    changeCheckListElementStatus: function (id) {
                        if(id){
                            crmTaskServices.changeCrmCheckListElementStatus({id: id}).$promise
                                .then(function (data) {
                                    self.loadCheckList(self.data.id);
                                })
                                .catch(function (error) {
                                    alert(JSON.parse(error.data.reason));
                                });
                        }
                    },
                    deleteCheckListElement: function (id) {
                        if(id){
                            crmTaskServices.deleteCrmCheckListElement({id: id}).$promise
                                .then(function (data) {
                                    self.loadCheckList(self.data.id);
                                })
                                .catch(function (error) {
                                    alert(JSON.parse(error.data.reason));
                                });
                        }
                    },
                    addSubTask: function (subtask) {
                        if(subtask){
                            crmTaskServices.addSubTask({id: self.data.id, subTask:subtask.id}).$promise
                                .then(function (data) {
                                    ngToast.create({
                                        dismissOnTimeout: true,
                                        timeout:2000,
                                        dismissButton: true,
                                        className: 'success',
                                        content: 'Підзадачу додано'
                                    });
                                    self.loadSubTasks(self.data.id);
                                    scope.clearSubTaskInput();
                                })
                                .catch(function (error) {
                                    ngToast.create({
                                        dismissOnTimeout: true,
                                        timeout:2000,
                                        dismissButton: true,
                                        className: 'warning',
                                        content: 'Підзадачу додати не вдалося'
                                    });
                                });
                        }
                    },
                    removeSubTask: function (subtaskId) {
                        if(subtaskId){
                            crmTaskServices.removeSubTask({subTask:subtaskId}).$promise
                                .then(function (data) {
                                    ngToast.create({
                                        dismissOnTimeout: true,
                                        timeout:2000,
                                        dismissButton: true,
                                        className: 'success',
                                        content: 'Підзадачу скасовано'
                                    });
                                    self.loadSubTasks(self.data.id);
                                })
                                .catch(function (error) {
                                    ngToast.create({
                                        dismissOnTimeout: true,
                                        timeout:2000,
                                        dismissButton: true,
                                        className: 'warning',
                                        content: 'Підзадачу скасувати не вдалося'
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
                                    .then(function (data) {
                                        return data.rows;
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
                                scope.comment = {
                                    id_task: null,
                                    message: null,
                                };
                                scope.newComment = false;
                                self.loadTasksComments(self.data.id);
                                scope.isDisabledComment = false;
                            })
                            .catch(function (error) {
                                scope.isDisabledComment = false;
                                alert(JSON.parse(error.data.reason));
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
                                alert('Операцію не вдалося виконати');
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
                                alert(JSON.parse(error.data.reason));
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
                                scope.openCommentDialog.close();
                            })
                            .catch(function (error) {
                                alert(JSON.parse(error.data.reason));
                            });
                    },
                    sendTask:function (notReload, clone) {
                        if(clone){
                            self.cloneTask();
                            return;
                        }
                        if (self.isModelValid()){
                            crmTaskServices.sendCrmTask({crmTask: angular.toJson(self.data)}).$promise
                                .then(function (data) {
                                    if (data.message === 'OK') {
                                        if(notReload){
                                            self.loadTask(data.id);
                                        }else{
                                            self.cleanTask();
                                        }
                                        ngToast.create({
                                            dismissOnTimeout: true,
                                            dismissButton: true,
                                            className: 'success',
                                            content: 'Завдання успішно додано'
                                        });
                                        scope.reloadTaskList({tasksType: scope.roleId});
                                    } else {
                                        alert(data.reason);
                                    }
                                    scope.isDisabled = false;
                                })
                                .catch(function (error) {
                                    scope.isDisabled = false;
                                    alert(JSON.parse(error.data.reason));
                                });
                        }
                        return false;
                    },
                    cloneTask:function () {
                        if (self.isModelValid()){
                            delete self.data.id;
                            crmTaskServices.sendCrmTask({crmTask: angular.toJson(self.data)}).$promise
                                .then(function (data) {
                                    if (data.message === 'OK') {
                                        $state.go("task/:id", {id:data.id}, {reload: true});
                                        ngToast.create({
                                            dismissOnTimeout: true,
                                            dismissButton: true,
                                            className: 'success',
                                            content: 'Завдання успішно клоновано'
                                        });
                                    } else {
                                        alert(data.reason);
                                    }
                                    scope.isDisabled = false;
                                })
                                .catch(function (error) {
                                    scope.isDisabled = false;
                                    alert(JSON.parse(error.data.reason));
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
                                    alert(data.reason);
                                }
                                scope.isDisabled = false;
                            })
                            .catch(function (error) {
                                scope.isDisabled = false;
                                alert(JSON.parse(error.data.reason));
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
                    rolesVisibility: function (role) {
                        if (self.data.roles[role]) scope.inputs[role] = true;
                        scope.inputs[role] = !scope.inputs[role];
                        if (!scope.inputs[role]) {
                            self.data.roles[role] = null;
                            if (role == 'producer') {
                                self.data.producer = null;
                            }
                            if (role == 'executant') {
                                self.data.executant = null;
                            }
                        }
                    }
                };
                self.loadTask(scope.taskId);
                self.loadSubTasks(scope.taskId);
                self.loadTaskDocuments(scope.taskId);
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

                scope.addListElement=function(listId) {
                    self.addElementToCheckList(listId);
                    self.checkList.newListElement=null;
                };

                //documents
                var documentUploader = scope.documentUploader = new FileUploader({
                    url: basePath + '/_teacher/crm/_tasks/tasks/uploadTaskDocuments?task='+scope.taskId,
                    removeAfterUpload: true
                });

                documentUploader.onCompleteAll = function() {
                    self.loadTaskDocuments(scope.taskId);
                };
                documentUploader.onErrorItem = function(item, response, status, headers) {
                    if(status==500)
                        alert("Виникла помилка при завантажені документа.");
                };

                documentUploader.filters.push({
                    name: 'imageFilter',
                    fn: function(item /*{File|FileLikeObject}*/, options) {
                        return true;
                    }
                });

                documentUploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
                    console.info('onWhenAddingFileFailed', item, filter, options);
                };

                // $rootScope.$on('$includeContentLoaded', function() {
                //     $timeout(function(){
                //         setEventToEditableField();
                //     });
                // });
                //
                // var setEventToEditableField = function() {
                //     $jq( ".cke_editable" ).keyup(function(e) {
                //     });
                // }
                // setEventToEditableField();
                //
                // scope.$watch('comment.message', function (newValue, oldValue) {
                //     // console.log(pressedSymbol);
                //     // if (pressedSymbol==="#"){
                //     //     console.log('ajax');
                //     // }
                // });
                // function keyUp(e){
                //     console.log(e.key);
                //     pressedSymbol=e.key;
                // }
                //
                // addEventListener("keyup", keyUp);
            }

            return {
                scope: {
                    'ckeditorOptions': '=ckeditorOptions',
                    'taskId':'=taskId',
                    'currentUser':'=currentUser',
                    'teacherMode':'=teacherMode',
                    'roleId':'=roleId',
                    'rolesCanEditCrmTasks':'=rolesCanEditCrmTasks',
                    'clone':'=clone',
                    reloadTaskList: '&callbackFn',
                },
                link: link,
                templateUrl: basePath + '/angular/js/crm/templates/task.html'
            };
        }])
/**
 * Created by Wizlight on 03.11.2015.
 */
angular
    .module('moduleRevisionsApp')
    .controller('courseModulesRevisionsCtrl',courseModulesRevisionsCtrl);

function courseModulesRevisionsCtrl($rootScope,$scope, $http, modulesRevisionsTree, moduleRevisionsActions) {
    //load current modules from main BD
    modulesRevisionsTree.getCurrentModules(idCourse).then(function (response) {
        $scope.currentModules = response;
    });

    //init tree after load json
    modulesRevisionsTree.getModuleRevisionsInCourse(idCourse).then(function(response){
        $rootScope.revisionsJson=response;
        $scope.revisionsTreeInit();
    });
    //init actions for revision tree
    var approverActions=[{
        "type": "button",
        "actionType": "approve",
        "title": "Затвердити",
        "visible": true,
        "userId":userId,
        "action": function(event) {
            var idRevision = $(event.data.el).attr('id');
            var nodeId = $(event.data.el).attr('data-nodeid');
            $scope.approveRev(idRevision, nodeId);
        }
    },
        {
            "type": "button",
            "actionType": "reject",
            "title": "Відхилити",
            "visible": true,
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                var nodeId = $(event.data.el).attr('data-nodeid');
                $scope.rejectRev(idRevision, nodeId);
            }
        },
        {
            "type": "button",
            "actionType": "cancel",
            "title": "Скасувати",
            "visible": true,
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                var nodeId = $(event.data.el).attr('data-nodeid');
                $scope.cancelRev(idRevision, nodeId);
            }
        },
        {
            "type": "button",
            "actionType": "release",
            "title": "Реліз",
            "visible": true,
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                var nodeId = $(event.data.el).attr('data-nodeid');
                $scope.releaseRev(idRevision, nodeId);
            }
        }
    ];
    var authorActions=[
        {
            "type": "button",
            "title": "Переглянути ревізії даного заняття",
            "visible": true,
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                $scope.$parent.openRevisionsBranch(idRevision);
            }
        },
        {
            "type": "button",
            "title": "Створити нову ревізію",
            "visible": true,
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                $scope.$parent.createRev(idRevision);
            }
        },
        {
            "type": "button",
            "title": "Переглянути",
            "visible": true,
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                $scope.$parent.previewRev(idRevision);
            }
        },
        {
            "type": "button",
            "title": "Написати автору ревізії",
            "visible": true,
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                $scope.$parent.sendRevisionMessage(idRevision);
            }
        }
    ];
    var generalActions=[
        {
            "type": "button",
            "actionType": "edit",
            "title": "Редагувати",
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                $scope.$parent.editRev(idRevision);
            }
        },
        {
            "type": "button",
            "actionType": "send",
            "title": "Відправити на затвердження",
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                var nodeId = $(event.data.el).attr('data-nodeid');
                $scope.sendRev(idRevision, nodeId);
            }
        },
        {
            "type": "button",
            "actionType": "cancelSend",
            "title": "Скасувати відправлення на затвердження",
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                var nodeId = $(event.data.el).attr('data-nodeid');
                $scope.cancelSendRev(idRevision, nodeId);
            }
        },
        {
            "type": "button",
            "actionType": "cancelEdit",
            "title": "Скасувати автором",
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                var nodeId = $(event.data.el).attr('data-nodeid');
                $scope.cancelEditRev(idRevision, nodeId);
            }
        },
        {
            "type": "button",
            "actionType": "restoreEdit",
            "title": "Відновити автором",
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                var nodeId = $(event.data.el).attr('data-nodeid');
                $scope.restoreEditRev(idRevision, nodeId);
            }
        },
    ];
    if(isApprover){
        var actions=approverActions.concat(authorActions, generalActions);
    }else{
        var actions=authorActions.concat(generalActions);
    }
    
    //init buttons
    $rootScope.addButtonsNg= function(treeData) {
        var treeButtons = {
            "title": "Дії",
            "actions": actions
        };
    
        $.each(treeData, function(k, v) {
            v['ddbutton'] = treeButtons;
    
            if (v['nodes']) {
                $rootScope.addButtonsNg(v['nodes']);
            }
        });
    };
    
    //edit revision status
    $scope.sendRev = function(id,nodeId) {
        moduleRevisionsActions.sendRevision(id).then(function(){
            $scope.updateModuleLecturesRevisionsTree(nodeId);
        });
    };
    $scope.cancelSendRev = function(id,nodeId) {
        moduleRevisionsActions.cancelSendRevision(id).then(function(){
            $scope.updateModuleLecturesRevisionsTree(nodeId);
        });
    };
    $scope.approveRev = function(id,nodeId) {
        moduleRevisionsActions.approveRevision(id).then(function(){
            $scope.updateModuleLecturesRevisionsTree(nodeId);
            modulesRevisionsTree.getCurrentLectures(idCourse).then(function (response) {
                $scope.currentLectures = response;
            });
        });
    };
    $scope.rejectRev = function(id,nodeId) {
        moduleRevisionsActions.rejectRevision(id).then(function(){
            $scope.updateModuleLecturesRevisionsTree(nodeId);
        });
    };
    $scope.cancelRev = function(id,nodeId) {
        moduleRevisionsActions.cancelRevision(id).then(function(){
            $scope.updateModuleLecturesRevisionsTree(nodeId);
            modulesRevisionsTree.getCurrentLectures(idCourse).then(function (response) {
                $scope.currentLectures = response;
            });
        });
    };
    $scope.releaseRev = function(id,nodeId) {
        moduleRevisionsActions.releaseRevision(id).then(function(){
            $scope.updateModuleLecturesRevisionsTree(nodeId);
            modulesRevisionsTree.getCurrentLectures(idCourse).then(function (response) {
                $scope.currentLectures = response;
            });
        });
    };
    $scope.cancelEditRev = function(id,nodeId) {
        moduleRevisionsActions.cancelEditByEditor(id).then(function(){
            $scope.updateModuleLecturesRevisionsTree(nodeId);
            modulesRevisionsTree.getCurrentLectures(idCourse).then(function (response) {
                $scope.currentLectures = response;
            });
        });
    };
    $scope.restoreEditRev = function(id,nodeId) {
        moduleRevisionsActions.restoreEditByEditor(id).then(function(){
            $scope.updateModuleLecturesRevisionsTree(nodeId);
            modulesRevisionsTree.getCurrentLectures(idCourse).then(function (response) {
                $scope.currentLectures = response;
            });
        });
    };
    //update revisions tree in module
    $scope.updateModuleLecturesRevisionsTree = function(nodeId){
        if($scope.allRevision || $scope.formData.revisionFilter=='undefined' || isEmptyFilter($scope.formData.revisionFilter)){
            modulesRevisionsTree.getLectureRevisionsInModuleJson(idCourse,$scope.approvedRevisions).then(function(response){
                $rootScope.revisionsJson=response;
                $scope.treeUpdate(nodeId);
            });
        }else{
            modulesRevisionsTree.revisionTreeFilterInModule(idCourse,$scope.formData).then(function (response) {
                $rootScope.revisionsJson=response;
                $scope.treeUpdate(nodeId);
            });
        }
    };
    
    $scope.loadTreeMode = function () {
        modulesRevisionsTree.getLectureRevisionsInModuleJson(idCourse,$scope.approvedRevisions).then(function (response) {
            $rootScope.revisionsJson = response;
            $scope.treeUpdate();
        });
    };
    
    $scope.updateTree = function() {
        modulesRevisionsTree.getLectureRevisionsInModuleJson(idCourse,$scope.approvedRevisions).then(function (response) {
            $rootScope.revisionsJson = response;
            $scope.revisionsTreeInit();
        });
    }
    
    $scope.formData = {};
    $scope.revisionFilter=function () {
        if($scope.allRevision || $scope.formData.revisionFilter=='undefined' || isEmptyFilter($scope.formData.revisionFilter)){
            $scope.updateTree();
        }else{
            modulesRevisionsTree.revisionTreeFilterInModule(idCourse,$scope.formData).then(function (response) {
                $rootScope.revisionsJson = response;
                $scope.treeUpdate();
            });
        }
    }
    
    function isEmptyFilter(obj) {
        for (var key in obj) {
            if(obj[key])
                return false;
        }
        return true;
    }
}

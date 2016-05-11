/**
 * Created by Wizlight on 26.04.2016.
 */
angular
    .module('revisionTreesApp')
    .controller('allRevisionsCtrl',allRevisionsCtrl);

function allRevisionsCtrl($rootScope, $scope, revisionsTree,revisionsActions) {
    //init tree after load json
    revisionsTree.getAllRevisionsJson().then(function(response){
        $rootScope.revisionsJson=response;
        $scope.$parent.revisionsTreeInit();
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
        }];
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
        revisionsActions.sendRevision(id).then(function(){
            $scope.updateRevisionsBranch(nodeId);
        });
    };
    $scope.cancelSendRev = function(id,nodeId) {
        revisionsActions.cancelSendRevision(id).then(function(){
            $scope.updateRevisionsBranch(nodeId);
        });
    };
    $scope.approveRev = function(id,nodeId) {
        revisionsActions.approveRevision(id).then(function(){
            $scope.updateRevisionsBranch(nodeId);
        });
    };
    $scope.rejectRev = function(id,nodeId) {
        revisionsActions.rejectRevision(id).then(function(){
            $scope.updateRevisionsBranch(nodeId);
        });
    };
    $scope.cancelRev = function(id,nodeId) {
        revisionsActions.cancelRevision(id).then(function(){
            $scope.updateRevisionsBranch(nodeId);
        });
    };
    //update revisions tree in module
    $scope.updateRevisionsBranch = function(nodeId){
        revisionsTree.getRevisionsBranch(idRevision).then(function(response){
            $rootScope.revisionsJson=response;
            $scope.$parent.treeUpdate(nodeId);
        });
    };

    $scope.updateTree = function() {
        revisionsTree.getAllRevisionsJson().then(function(response){
            $rootScope.revisionsJson=response;
            $scope.revisionsTreeInit();
        });
    }
}



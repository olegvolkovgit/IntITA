/**
 * Created by Wizlight on 26.04.2016.
 */
angular
    .module('revisionTreesApp')
    .controller('revisionsBranchCtrl',revisionsBranchCtrl)
    .filter('arrow', function() {
        return function(input) {
            return input ? '\u21a7' : '\u21a5';
        };
    });

function revisionsBranchCtrl($rootScope, $scope, revisionsTree,revisionsActions) {
    $scope.formData = {};
    //load list of module authors. First params - id module, second - id lecture revision. If two params are null - load all authors of revisions 
    revisionsTree.getRevisionsAuthors(null,idRevision).then(function(response){
        $scope.authors=response;
        $scope.authors.unshift({authorName:"Всі автори", id:"0"});
        $scope.selectedAuthor = $scope.authors[0];
    });
    //init tree after load json
    revisionsTree.getRevisionsBranch(idRevision).then(function(response){
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
            "actionType": "proposedToRelease",
            "title": "Запропонувати до релізу",
            "visible": true,
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                var nodeId = $(event.data.el).attr('data-nodeid');
                $scope.proposedToReleaseRev(idRevision, nodeId);
            }
        },
        {
            "type": "button",
            "actionType": "cancelProposedToRelease",
            "title": "Відхилити пререліз",
            "visible": true,
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                var nodeId = $(event.data.el).attr('data-nodeid');
                $scope.cancelPreReleaseRev(idRevision, nodeId);
            }
        }
    ];
    var authorActions=[
        {
            "type": "button",
            "title": "Створити нову ревізію",
            "actionType": "create",
            "visible": true,
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                $scope.createRev(idRevision);
            }
        },
        {
            "type": "button",
            "title": "Переглянути",
            "visible": true,
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                $scope.previewRev(idRevision);
            }
        },
        {
            "type": "button",
            "title": "Написати автору ревізії",
            "visible": true,
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                $scope.sendRevisionMessage(idRevision);
            }
        },
        {
            "type": "button",
            "actionType": "create",
            "title": "Клонувати ревізію в нову гілку",
            "visible": true,
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                $scope.cloneRev(idRevision);
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
                $scope.editRev(idRevision);
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
        bootbox.dialog({
            title: "Ти впевнений, що хочеш відхилити ревізію?",
                message: '<div class="panel-body"><div class="row"><form role="form" name="rejectMessage"><div class="form-group col-md-12">'+
                '<textarea class="form-control" style="resize: none" rows="6" id="rejectMessageText" placeholder="тут можна залишити коментар при відхилені ревізії"></textarea>'+
                '</div></form></div></div>',
                buttons: {success: {label: "Підтвердити", className: "btn btn-primary",
                    callback: function () {
                        var comment = $('#rejectMessageText').val();
                        revisionsActions.rejectRevision(id, comment).then(function(){
                            $scope.updateRevisionsBranch(nodeId);
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
    $scope.cancelRev = function(id,nodeId) {
        revisionsActions.cancelRevision(id).then(function(){
            $scope.updateRevisionsBranch(nodeId);
        });
    };
    $scope.cancelEditRev = function(id,nodeId) {
        revisionsActions.cancelEditByEditor(id).then(function(){
            $scope.updateRevisionsBranch(nodeId);
        });
    };
    $scope.restoreEditRev = function(id,nodeId) {
        revisionsActions.restoreEditByEditor(id).then(function(){
            $scope.updateRevisionsBranch(nodeId);
        });
    };
    $scope.releaseRev = function(id,nodeId) {
        revisionsActions.releaseRevision(id).then(function(){
            $scope.updateRevisionsBranch(nodeId);
        });
    };
    $scope.cancelPreReleaseRev = function(id,nodeId) {
        revisionsActions.cancelPreReleaseRevision(id).then(function(){
            $scope.updateRevisionsBranch(nodeId);
        });
    };
    $scope.proposedToReleaseRev = function(id,nodeId) {
        revisionsActions.proposedToReleaseRevision(id).then(function(){
            $scope.updateRevisionsBranch(nodeId);
        });
    };
    //update revisions tree in module
    $scope.updateRevisionsBranch = function(nodeId){
        if($scope.allRevision || $scope.formData.revisionFilter=='undefined' || isEmptyFilter($scope.formData.revisionFilter) && $scope.selectedAuthor.id==0){
            revisionsTree.getRevisionsBranch(idRevision).then(function (response) {
                $rootScope.revisionsJson=response;
                $scope.treeUpdate(nodeId);
            });
        }else{
            revisionsTree.revisionTreeFilterInBranch(idRevision,$scope.formData, $scope.selectedAuthor.id).then(function (response) {
                $rootScope.revisionsJson=response;
                $scope.treeUpdate(nodeId);
            });
        }
    };

    $scope.loadTreeMode = function () {
        revisionsTree.getRevisionsBranch(idRevision).then(function (response) {
            $rootScope.revisionsJson = response;
            $scope.treeUpdate();
        });
    };

    $scope.updateTree = function() {
        revisionsTree.getRevisionsBranch(idRevision).then(function(response){
            $rootScope.revisionsJson=response;
            $scope.revisionsTreeInit();
        });
    };

    $scope.revisionFilter=function () {
        if($scope.allRevision || $scope.formData.revisionFilter=='undefined' || isEmptyFilter($scope.formData.revisionFilter) && $scope.selectedAuthor.id==0){
            $scope.updateTree();
        }else{
            revisionsTree.revisionTreeFilterInBranch(idRevision,$scope.formData, $scope.selectedAuthor.id).then(function (response) {
                $rootScope.revisionsJson = response;
                $scope.treeUpdate();
            });
        }
    };

    function isEmptyFilter(obj) {
        for (var key in obj) {
            if(obj[key])
                return false;
        }
        return true;
    }
}



/**
 * Created by Wizlight on 03.11.2015.
 */
angular
    .module('courseRevisionsApp')
    .controller('allCoursesRevisionsCtrl',allCoursesRevisionsCtrl)
    .filter('arrow', function() {
        return function(input) {
            return input ? '\u21a7' : '\u21a5';
        };
    });

function allCoursesRevisionsCtrl($rootScope,$scope, courseRevisionsTree, courseRevisionsActions, $attrs) {
    $scope.formData = {};
    courseRevisionsTree.getCourseRevisionsAuthors().then(function(response){
        $scope.authors=response;
        $scope.authors.unshift({authorName:"Всі автори", id:"0"});
        $scope.selectedAuthor = $scope.authors[0];
    });
    //init tree after load json
    courseRevisionsTree.getAllCoursesRevisionsJson({organization:$attrs.organization}).then(function(response){
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
            $scope.approveCourseRev(idRevision, nodeId);
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
                $scope.rejectCourseRev(idRevision, nodeId);
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
                $scope.cancelCourseRev(idRevision, nodeId);
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
                $scope.releaseCourseRev(idRevision, nodeId);
            }
        }
    ];
    var authorActions=[
        {
            "type": "button",
            "title": "Переглянути ревізії даного курсу",
            "visible": true,
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                $scope.openCourseRevisionsBranch(idRevision);
            }
        },
        {
            "type": "button",
            "title": "Створити нову ревізію",
            "visible": true,
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                $scope.createCourseRev(idRevision);
            }
        },
        {
            "type": "button",
            "title": "Переглянути",
            "visible": true,
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                $scope.previewCourseRev(idRevision);
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
                $scope.editCourseRev(idRevision);
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
                $scope.sendCourseRev(idRevision, nodeId);
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
                $scope.cancelSendCourseRev(idRevision, nodeId);
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
                $scope.cancelEditCourseRev(idRevision, nodeId);
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
                $scope.restoreEditCourseRev(idRevision, nodeId);
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
    $scope.sendCourseRev = function(id,nodeId) {
        courseRevisionsActions.sendCourseRevision(id).then(function(){
            $scope.updateAllCourseRevisionsTree(nodeId);
        });
    };
    $scope.cancelSendCourseRev = function(id,nodeId) {
        courseRevisionsActions.cancelSendCourseRevision(id).then(function(){
            $scope.updateAllCourseRevisionsTree(nodeId);
        });
    };
    $scope.approveCourseRev = function(id,nodeId) {
        courseRevisionsActions.approveCourseRevision(id).then(function(){
            $scope.updateAllCourseRevisionsTree(nodeId);
        });
    };
    $scope.rejectCourseRev = function(id,nodeId) {
        // bootbox.dialog({
        //     title: "Ти впевнений, що хочеш відхилити ревізію?",
        //         message: '<div class="panel-body"><div class="row"><form role="form" name="rejectMessage"><div class="form-group col-md-12">'+
        //         '<textarea class="form-control" style="resize: none" rows="6" id="rejectMessageText" placeholder="тут можна залишити коментар при відхилені ревізії"></textarea>'+
        //         '</div></form></div></div>',
        //         buttons: {success: {label: "Підтвердити", className: "btn btn-primary",
        //             callback: function () {
        //                 var comment = $('#rejectMessageText').val();
                        courseRevisionsActions.rejectCourseRevision(id).then(function(){
                            $scope.updateAllCourseRevisionsTree(nodeId);
                        });
                    // }
                // },
                //     cancel: {label: "Скасувати", className: "btn btn-default",
                //         callback: function () {
                //         }
                //     }
                // }
            // }
        // );
    };
    $scope.cancelCourseRev = function(id,nodeId) {
        courseRevisionsActions.cancelCourseRevision(id).then(function(){
            $scope.updateAllCourseRevisionsTree(nodeId);
        });
    };
    $scope.releaseCourseRev = function(id,nodeId) {
        courseRevisionsActions.releaseCourseRevision(id).then(function(){
            $scope.updateAllCourseRevisionsTree(nodeId);
        });
    };
    $scope.cancelEditCourseRev = function(id,nodeId) {
        courseRevisionsActions.cancelCourseEditByEditor(id).then(function(){
            $scope.updateAllCourseRevisionsTree(nodeId);
        });
    };
    $scope.restoreEditCourseRev = function(id,nodeId) {
        courseRevisionsActions.restoreCourseEditByEditor(id).then(function(){
            $scope.updateAllCourseRevisionsTree(nodeId);
        });
    };
    //update course revisions tree
    $scope.updateAllCourseRevisionsTree = function(nodeId){
        if($scope.allRevision || $scope.formData.revisionFilter=='undefined' || isEmptyFilter($scope.formData.revisionFilter) && $scope.selectedAuthor.id==0){
            courseRevisionsTree.getAllCoursesRevisionsJson().then(function(response){
                $rootScope.revisionsJson=response;
                $scope.treeUpdate(nodeId);
            });
        }else{
            courseRevisionsTree.allCoursesRevisionsTreeFilter($scope.formData, $scope.selectedAuthor.id).then(function (response) {
                $rootScope.revisionsJson=response;
                $scope.treeUpdate(nodeId);
            });
        }
    };

    $scope.updateTree = function() {
        courseRevisionsTree.getAllCoursesRevisionsJson().then(function (response) {
            $rootScope.revisionsJson = response;
            $scope.revisionsTreeInit();
        });
    };

    $scope.revisionFilter=function () {
        if($scope.allRevision || $scope.formData.revisionFilter=='undefined' || isEmptyFilter($scope.formData.revisionFilter) && $scope.selectedAuthor.id==0){
            $scope.updateTree();
        }else{
            courseRevisionsTree.allCoursesRevisionsTreeFilter($scope.formData, $scope.selectedAuthor.id).then(function (response) {
                $rootScope.revisionsJson=response;
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

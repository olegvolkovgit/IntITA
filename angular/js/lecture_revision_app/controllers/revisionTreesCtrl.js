/**
 * Created by Wizlight on 26.04.2016.
 */
angular
    .module('revisionTreesApp')
    .controller('revisionTreesCtrl',revisionTreesCtrl);

function revisionTreesCtrl($compile, $scope, $http) {
    if(idLecture) var idTree=idLecture;
        else if(idModule) var idTree=idModule;
    else idTree=null;

    //load current lectures from main BD
    if(idModule) {
        $scope.getCurrentLectures = function (idModule) {
            var promise = $http({
                url: basePath + '/revision/buildCurrentLectureJson',
                method: "POST",
                data: $.param({idModule: idModule}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            }).then(function successCallback(response) {
                return response.data;
            }, function errorCallback() {
                bootbox.alert("Виникла помилка при завантажені списку актуальних занять модуля. Зв'яжіться з адміністрацією");
                return false;
            });
            return promise;
        };
        $scope.getCurrentLectures(idModule).then(function (response) {
            $scope.currentLectures = response;
        });
    }

    //lectures json for revision tree
    if(idLecture){
        $scope.getLectureRevisionsJson = function(idLecture) {
            var promise = $http({
                url: basePath+'/revision/buildLectureRevisions',
                method: "POST",
                data: $.param({idLecture: idLecture}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            }).then(function successCallback(response) {
                return response.data;
            }, function errorCallback() {
                bootbox.alert("Виникла помилка при завантажені списку ревізій модуля. Зв'яжіться з адміністрацією");
                return false;
            });
            return promise;
        };
    }else if(idModule){
        $scope.getLectureRevisionsJson = function(idModule) {
            var promise = $http({
                url: basePath+'/revision/buildRevisionsInModule',
                method: "POST",
                data: $.param({idModule: idModule}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            }).then(function successCallback(response) {
                return response.data;
            }, function errorCallback() {
                bootbox.alert("Виникла помилка при завантажені списку ревізій модуля. Зв'яжіться з адміністрацією");
                return false;
            });
            return promise;
        };
    }else{
        $scope.getLectureRevisionsJson = function() {
            var promise = $http({
                url: basePath+'/revision/buildAllRevisions',
                method: "POST",
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            }).then(function successCallback(response) {
                return response.data;
            }, function errorCallback() {
                bootbox.alert("Виникла помилка при завантажені списку ревізій. Зв'яжіться з адміністрацією");
                return false;
            });
            return promise;
        };
    }

    //init tree after load json
    $scope.getLectureRevisionsJson(idTree).then(function(response){
        $scope.revisionsJson=response;
        $('#tree').treeview({
            data: $scope.getTree(),
            levels: 0
        });
    });
    $scope.getTree = function() {
        var treeData = $scope.revisionsJson;
        //load custom buttons for node tree
        $scope.addButtonsNg(treeData);
        return treeData;
    };
    $scope.treeUpdate = function(nodeId) {
        $('#tree').treeview({
            data: $scope.getTree(),
            levels: 0
        });
        $('#tree').treeview('revealNode', [ parseInt(nodeId), { silent: true } ]);
        var template = angular.element(document.querySelector("#tree"));
        $compile(template)($scope);
    };
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
            $scope.approveRevision(idRevision, nodeId);
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
                $scope.rejectRevision(idRevision, nodeId);
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
                $scope.cancelRevision(idRevision, nodeId);
            }
        }];
    var authorActions=[
        {
            "type": "button",
            "title": "Створити нову ревізію",
            "visible": true,
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                createRevision(idRevision);
            }
        },
        {
            "type": "button",
            "title": "Переглянути",
            "visible": true,
            "userId":userId,
            "action": function(event) {
                var idRevision = $(event.data.el).attr('id');
                previewRevision(idRevision);
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
                editRevision(idRevision);
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
                $scope.sendRevision(idRevision, nodeId);
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
                $scope.cancelSendRevision(idRevision, nodeId);
            }
        },
    ];
    if(isApprover){
        var actions=approverActions.concat(authorActions, generalActions);
    }else{
        var actions=authorActions.concat(generalActions);
    }
    //console.log(actions);
    //init buttons
    $scope.addButtonsNg= function(treeData) {
        var treeButtons = {
            "title": "Дії",
            "actions": actions
        };

        $.each(treeData, function(k, v) {
            v['ddbutton'] = treeButtons;

            if (v['nodes']) {
                $scope.addButtonsNg(v['nodes']);
            }
        });
    }

    //edit revision status
    $scope.sendRevision = function(id,nodeId) {
        $http({
            url: basePath+'/revision/sendForApproveLecture',
            method: "POST",
            data: $.param({idRevision: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback() {
            $scope.getLectureRevisionsJson(idTree).then(function(response){
                $scope.revisionsJson=response;
                $scope.treeUpdate(nodeId);
            });
        }, function errorCallback() {
            bootbox.alert("Відправити заняття на затвердження не вдалося. Зв'яжіться з адміністрацією");
            return false;
        });
    };
    $scope.cancelSendRevision = function(id,nodeId) {
        $http({
            url: basePath+'/revision/cancelSendForApproveLecture',
            method: "POST",
            data: $.param({idRevision: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback() {
            $scope.getLectureRevisionsJson(idTree).then(function(response){
                $scope.revisionsJson=response;
                $scope.treeUpdate(nodeId);
            });
        }, function errorCallback() {
            bootbox.alert("Відмінити відправлення заняття на затвердження не вдалося. Зв'яжіться з адміністрацією");
            return false;
        });
    };
    $scope.approveRevision = function(id,nodeId) {
        $http({
            url: basePath+'/revision/approveLectureRevision',
            method: "POST",
            data: $.param({idRevision: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback() {
            $scope.getLectureRevisionsJson(idTree).then(function(response){
                $scope.revisionsJson=response;
                $scope.treeUpdate(nodeId);
            });
        }, function errorCallback() {
            bootbox.alert("Затвердити заняття не вдалося. Зв'яжіться з адміністрацією");
            return false;
        });
    };
    $scope.rejectRevision = function(id,nodeId) {
        $http({
            url: basePath+'/revision/rejectLectureRevision',
            method: "POST",
            data: $.param({idRevision: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback() {
            $scope.getLectureRevisionsJson(idTree).then(function(response){
                $scope.revisionsJson=response;
                $scope.treeUpdate(nodeId);
            });
        }, function errorCallback() {
            bootbox.alert("Відхилити відправку на затвердження не вдалося. Зв'яжіться з адміністрацією");
            return false;
        });
    };
    $scope.cancelRevision = function(id,nodeId) {
        $http({
            url: basePath+'/revision/cancelLectureRevision',
            method: "POST",
            data: $.param({idRevision: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback() {
            $scope.getLectureRevisionsJson(idTree).then(function(response){
                $scope.revisionsJson=response;
                $scope.treeUpdate(nodeId);
            });
        }, function errorCallback() {
            bootbox.alert("скасувати заняття не вдалося. Зв'яжіться з адміністрацією");
            return false;
        });
    };

    function createRevision(idRevision) {
        location.href = basePath+'/revision/createLectureRevision?idRevision=' + idRevision;
    }

    function previewRevision(idRevision) {
        location.href = basePath+'/revision/previewLectureRevision?idRevision=' + idRevision;
    }

    function editRevision(idRevision) {
        location.href = basePath+'/revision/EditLectureRevision?idRevision=' + idRevision;
    }

    //trees manipulations
    $scope.clearSearch = function() {
        $('#input-select-node').val('');
        $('#tree').treeview('clearSearch');
    };
    $scope.collapseAll = function() {
        $('#tree').treeview('collapseAll', { silent: true });
    };
        $scope.expandAll = function() {
        $('#tree').treeview('expandAll', { silent: true });
    };
    var findSelectableNodes = function() {
        return $('#tree').treeview('search', [ $('#input-select-node').val(), { ignoreCase: false, exactMatch: false } ]);
    };
    $('#input-select-node').on('keyup', function (e) {
        var selectableNodes = findSelectableNodes();
        $('.select-node').prop('disabled', !(selectableNodes.length >= 1));
    });
}



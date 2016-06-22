/**
 * Created by Wizlight on 26.04.2016.
 */
angular
    .module('moduleRevisionsApp')
    .controller('moduleRevisionsTreeCtrl',moduleRevisionsTreeCtrl)
    .filter('arrow', function() {
        return function(input) {
            return input ? '\u21a7' : '\u21a5';
        };
    });

function moduleRevisionsTreeCtrl($compile, $rootScope, $scope) {
    //init tree after load json
    $scope.revisionsTreeInit= function(){
        $('#tree').treeview({
            data: $scope.getTree(),
            levels: 0
        });
    };
    $scope.getTree = function() {
        var treeData = $rootScope.revisionsJson;
        //load custom buttons for node tree
        $rootScope.addButtonsNg(treeData);
        return treeData;
    };
    //updateTree
    $scope.treeUpdate = function(nodeId) {
        $('#tree').treeview({
            data: $scope.getTree(),
            levels: 0
        });
        if (nodeId) {
            $('#tree').treeview('revealNode', [parseInt(nodeId), {silent: true}]);
        }
        var template = angular.element(document.querySelector("#tree"));
        $compile(template)($scope);
    };

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

    $scope.createModuleRev = function(idRevision) {
        location.href = basePath+'/moduleRevision/createModuleRevision?idRevision=' + idRevision;
    };
    $scope.previewModuleRev = function(idRevision) {
        location.href = basePath+'/moduleRevision/previewModuleRevision?idRevision=' + idRevision;
    };
    $scope.editModuleRev = function(idRevision) {
        location.href = basePath+'/moduleRevision/editModuleRevisionPage?idRevision=' + idRevision;
    };
    // $scope.openRevisionsBranch = function(idRevision) {
    //     location.href = basePath+'/moduleRevision/revisionsBranch?idRevision=' + idRevision;
    // };
    // $scope.sendRevisionMessage = function(idRevision) {
        // revisionMessage.sendMessage(idRevision);
    // };
}



angular
    .module('courseRevisionsApp')
    .controller('courseRevisionsTreeCtrl',courseRevisionsTreeCtrl)
    .filter('arrow', function() {
        return function(input) {
            return input ? '\u21a7' : '\u21a5';
        };
    });

function courseRevisionsTreeCtrl($compile, $rootScope, $scope, $http, courseRevisionMessage) {
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

    $scope.createCourseRev = function(idRevision) {
        location.href = basePath+'/courseRevision/createCourseRevision?idRevision=' + idRevision;
    };
    $scope.previewCourseRev = function(idRevision) {
        location.href = basePath+'/courseRevision/previewCourseRevision?idRevision=' + idRevision;
    };
    $scope.editCourseRev = function(idRevision) {
        location.href = basePath+'/courseRevision/editCourseRevisionPage?idRevision=' + idRevision;
    };
    $scope.openCourseRevisionsBranch = function(idRevision) {
        $http({
            url: basePath+'/courseRevision/getCourseByRevision',
            method: "POST",
            data: $.param({idRevision: idRevision}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            location.href = basePath+'/courseRevision/courseRevisions?idCourse=' + response.data;
        }, function errorCallback() {
            bootbox.alert("Помилка при отримані ревізії курсу. Спробуйте ще раз або зв'яжіться з адміністратором сайту.");
            return false;
        });

    };
    $scope.sendCourseRevisionMessage = function(idRevision) {
        courseRevisionMessage.sendMessage(idRevision);
    };
}



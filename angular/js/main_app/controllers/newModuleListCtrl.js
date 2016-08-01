/**
 * Created by Wizlight on 15.02.2016.
 */
angular
    .module('mainApp')
    .controller('newModuleListCtrl',newModuleListCtrl)

function newModuleListCtrl($scope) {
    $scope.enableEdit=function () {
        $scope.editVisible=true;
    };
    $scope.showForm=function () {
        document.getElementById('moduleForm').style.display = 'block';
    };
}

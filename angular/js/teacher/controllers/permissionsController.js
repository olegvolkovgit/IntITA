/**
 * Created by adm on 31.08.2016.
 */

angular.module('teacherApp').controller('permissionsCtrl',permissionsCtrl);

function permissionsCtrl ($scope, typeAhead, $http){
    $scope.selectedTeacher=null;
    $scope.onSelect = function ($item) {
        $scope.selectedTeacher = $item;
        console.log($item);
    };
    var teachersTypeaheadUrl = basePath+'/_teacher/_admin/module/teachersByQuery';
    var moduleTypeaheadUrl = basePath + '/_teacher/_admin/permissions/modulesByQuery';
    $scope.getTeachers = function(value){
        return typeAhead.getData(teachersTypeaheadUrl,value)
    }
    $scope.getModules = function(value){
            return typeAhead.getData(moduleTypeaheadUrl,value);

    }
}

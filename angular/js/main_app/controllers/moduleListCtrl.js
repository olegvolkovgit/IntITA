/**
 * Created by Wizlight on 15.02.2016.
 */
angular
    .module('mainApp')
    .controller('moduleListCtrl',moduleListCtrl)

function moduleListCtrl($http,$scope) {
    $scope.getModuleProgressForUser=function (idCourse) {
        var promise = $http({
            url: basePath+'/course/modulesData',
            method: "POST",
            data: $.param({id: idCourse}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return response.data;
        }, function errorCallback() {
            return false;
        });
        return promise;
    };
    $scope.getModuleProgressForUser(idCourse).then(function (response) {
        $scope.basePath=basePath;
        $scope.modulesProgress=response;
        if(!$scope.modulesProgress.userId){
            $scope.modulesProgress.ico='disabled.png';
        }
        console.log($scope.modulesProgress);
    });
}
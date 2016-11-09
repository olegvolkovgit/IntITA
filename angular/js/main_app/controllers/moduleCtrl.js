/**
 * Created by Wizlight on 15.02.2016.
 */
angular
    .module('mainApp')
    .controller('moduleCtrl',moduleCtrl);

function moduleCtrl($scope) {
    $scope.redirectToCabinet=function (scenario,id) {
        $scope.educationForm='online';
        $scope.schemeId=0;
        location.href = basePath + '/cabinet#/'+scenario+'/'+id+'/'+$scope.educationForm+'/scheme/'+$scope.schemeId;
    };
}

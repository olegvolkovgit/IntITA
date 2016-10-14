/**
 * Created by Wizlight on 15.02.2016.
 */
angular
    .module('mainApp')
    .controller('moduleCtrl',moduleCtrl);

function moduleCtrl($scope) {
    $scope.redirectToCabinet=function (scenario,id) {
        $scope.educationForm=1;
        $scope.schemeType=1;
        location.href = basePath + '/cabinet#/'+scenario+'/'+id+'/educationForm/'+$scope.educationForm+'/scheme/'+$scope.schemeType;
    };
}

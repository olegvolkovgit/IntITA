angular
    .module('lessonEdit')
    .controller('plainTaskCtrl', plainTaskCtrl)

function plainTaskCtrl($scope, $http) {

    $scope.getDataPlainTask = function(id) {
        var promise = $http({
            url: basePath+'/revision/plainTaskCondition',
            method: "POST",
            data: $.param({idBlock: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return response.data;
        }, function errorCallback() {
            return false;
        });
        return promise;
    };
    $scope.getDataPlainTask($scope.idBlock).then(function (response) {
        $scope.dataSkipTask=response;
    });

}
angular
    .module('lessonEdit')
    .controller('testCtrl', testCtrl)

function testCtrl($scope, $http) {

    $scope.getDataTest = function(id) {
        var promise = $http({
            url: basePath+'/revision/dataTest',
            method: "POST",
            data: $.param({idPage: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return response.data;
        }, function errorCallback() {
            return false;
        });
        return promise;
    };
    $scope.getDataTest($scope.idPage).then(function (response) {
        $scope.dataTest=response;
    });

    $scope.editAddAnswer = function () {
        $scope.dataTest.answers.push('');
        $scope.dataTest.valid.push(false);
        var optionsNum = angular.element(document.querySelector("#optionsNum"));
        optionsNum.val(parseInt(optionsNum.val()) + 1);
    };
    $scope.editDeleteAnswer = function () {
        $scope.dataTest.answers.splice(-1, 1);
        $scope.dataTest.valid.splice(-1, 1);
        var optionsNum = angular.element(document.querySelector("#optionsNum"));
        if (optionsNum.val() > 0) {
            optionsNum.val(parseInt(optionsNum.val()) - 1);
        }
    };
}
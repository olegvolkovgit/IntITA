/**
 * Created by Wizlight on 03.11.2015.
 */
angular
    .module('revisionPreviewApp')
    .controller('lectureRevisionCtrl',lectureRevisionCtrl);

function lectureRevisionCtrl($rootScope,$scope, $http) {
    $scope.getRevisionData = function(id) {
        var promise = $http({
            url: basePath+'/revision/getRevisionPreviewData',
            method: "POST",
            data: $.param({idRevision: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return response.data;
        }, function errorCallback() {
            return false;
        });
        return promise;
    };
    $scope.getRevisionData(idRevision).then(function (response) {
        $rootScope.pageData=response;
    });
}

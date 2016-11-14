/**
 * Created by adm on 13.11.2016.
 */
angular
    .module('teacherApp')
    .controller('newsletterCtrl',newsletterCtrl);

function newsletterCtrl($scope, $http, $resource) {

    var rolesArray = $resource(basePath+'/_teacher/newsletter/getRoles');

    $scope.getRoles = function(query, querySelectAs) {
      return rolesArray.query().$promise.then(function(response) {
            return response;
        });
    };

    $scope.send = function () {
        var recipients =[];
        angular.forEach($scope.selectedRoles, function(value) {
            recipients.push(value.id)
        });
         $http({
             method:'POST',
             url:basePath+'/_teacher/newsletter/sendLetter',
             data: $jq.param({"type":$scope.newsletterType, "recipients":recipients,"subject":$scope.subject,"message":$scope.message}),
             headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        });
    }

}
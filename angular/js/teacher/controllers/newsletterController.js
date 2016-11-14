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
        $http({
            method:'POST',
            url:basePath+'/_teacher/newsletter/sendLetter',
            data: $jq.param({"users":$scope.selectedRoles }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        });
    }

}
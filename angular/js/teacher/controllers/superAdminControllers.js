/**
 * Created by Wizlight on 03.04.2017.
 */

angular
    .module('teacherApp')
    .controller('mainSuperAdminCtrl', mainSuperAdminCtrl)

function mainSuperAdminCtrl($scope, $rootScope, $http) {
    $scope.getNewResponses=function(){
        $http({
            method:'POST',
            url: basePath + '/_teacher/_super_admin/response/getNewResponsesCount',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response){;
            $rootScope.countOfNewResponses=response;
        }).error(function(){
            console.log("Отримати дані про нові відгуки про викладачів не вдалося");
        })
    };
    $scope.getNewResponses();
}
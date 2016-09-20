/**
 * Created by adm on 20.09.2016.
 */
angular
    .module('teacherApp')
    .controller('requestsCtrl',requestsCtrl);

function  requestsCtrl($scope){

    $scope.initActiveRequests = function(){
        initActiveRequestsTable();
    }
    $scope.initApprovedRequests = function(){
        initApprovedRequestsTable();
    }
    $scope.initDeletedRequests = function(){
        initDeletedRequestsTable();
    }
    $scope.initRejectedRevisionRequests = function(){
        initRejectedRevisionRequestsTable();
    }
}

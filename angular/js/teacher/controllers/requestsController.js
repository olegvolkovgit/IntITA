/**
 * Created by adm on 20.09.2016.
 */
angular
    .module('teacherApp')
    .controller('requestsCtrl',requestsCtrl);

function  requestsCtrl($scope, $http, $ngBootbox, $state){

    $scope.comment ="";

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

    $scope.initActiveRequests();

    $scope.setRequestStatus = function(message, user) {
        $http({
            url:basePath+'/_teacher/_admin/request/approve/message/'+message+'/user/'+user,
            type:'POST'
        }).success(function(response){
                $ngBootbox.alert(response).then(
                    function(){
                        $state.go('requests');
                    }
                )
        }

        )
          .error(function(){
              $ngBootbox.alert('Операцію не вдалося виконати.')
          });
    };

    $scope.setCoworkerRequest = function(message, user) {
        $http({
            url:basePath+'/_teacher/_admin/teachers/create/',
            type:'POST',
            data: {message: message, user: user},
            headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
        }).success(function(response){
                $ngBootbox.alert(response).then(
                    function(){
                        $state.go('requests');
                    }
                )
            }

            )
            .error(function(){
                $ngBootbox.alert('Операцію не вдалося виконати.')
            });
    };

    $scope.cancelMessage = function(){
        $ngBootbox.alert('Операцію відмінено.');
    }

    $scope.cancelRequest = function(message,user){
        $http({
            url:basePath+'/_teacher/_admin/request/reject/message/'+message+'/user/'+user,
            type:'POST',
            data: {comment: $scope.comment},
            headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
        }).success(function(response){
                $ngBootbox.alert(response).then(
                    function(){
                        $scope.comment = "";
                        $state.go('requests');
                    }
                )
            }

            )
            .error(function(){
                $ngBootbox.alert('Операцію не вдалося виконати.')
            });
    }

}
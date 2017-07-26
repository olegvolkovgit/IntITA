/**
 * Created by adm on 19.07.2016.
 */

angular
    .module('crmApp')
    .controller('crmTasksCtrl', ['$scope','ModalService',
        function ($scope, ModalService) {
            $scope.changePageHeader('Завдання');

            $scope.openModal=function(id){
                ModalService.Open(id);
            }
        }]);
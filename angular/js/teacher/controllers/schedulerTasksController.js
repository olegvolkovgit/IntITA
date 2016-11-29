/**
 * Created by adm on 19.07.2016.
 */
angular
    .module('teacherApp')
    .controller('schedulerTasksCtrl',schedulerTasksCtrl);


function schedulerTasksCtrl($scope, $state, $resource, NgTableParams){

    $scope.schedulerTasksTable = new NgTableParams({

    }, {
        getData: function(params) {
            return $resource(basePath+"/_teacher/schedulerTasks/getTasksList").get(params.url()).$promise.then(function(data) {
                params.total(data.count);
                return data.rows;
            });
        }
    });

}
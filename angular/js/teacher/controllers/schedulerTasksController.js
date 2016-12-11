/**
 * Created by adm on 19.07.2016.
 */
angular
    .module('teacherApp')
    .controller('schedulerTasksCtrl',schedulerTasksCtrl);


function schedulerTasksCtrl($scope, $state, $resource, NgTableParams){

    $scope.repeatFilter = [{ id: 1, title: "Однократно"},
                          { id: 2, title: "Раз на день"},
                          { id: 3, title: "Раз на тиждень"},
                          { id: 4, title: "Раз на місяць"},
                          { id: 5, title: "Раз на рік"}

    ];

    $scope.statusesFilter = [{ id: 1, title: "Заплановано"},
                            { id: 2, title: "В процесі"},
                            { id: 3, title: "Завершено"},
                            { id: 4, title: "Помилка"},
                            { id: 5, title: "Скасовано"}

    ];

    $scope.typesFilter = [{ id: 1, title: "Розсилка електронних листів"},

    ];

    $scope.schedulerTasksTable = new NgTableParams({
        sorting: { start_time: "desc" }
    }, {
        getData: function(params) {
            return $resource(basePath+"/_teacher/schedulerTasks/getTasksList").get(params.url()).$promise.then(function(data) {
                params.total(data.count);
                return data.rows;
            });
        }
    });

}
/**
 * Created by adm on 23.08.2016.
 */
angular
    .module('teacherApp')
    .controller('levelsCtrl',levelsCtrl)

function levelsCtrl ($scope, levels, NgTableParams){

    $scope.changePageHeader('Рівні курсів, модулів');
    $scope.tableParams = new NgTableParams({}, {
        getData: function(params) {
            return levels.list({
                    page: params.page(),
                    pageCount: params.count()
                })
                .$promise
                .then(function (data) {
                    params.total(data.count); // recal. page nav controls
                    return data.rows;
                });
        }
    });

}
/**
 * Created by adm on 23.08.2016.
 */
angular
    .module('teacherApp')
    .controller('siteConfigCtrl',siteConfigCtrl)

function siteConfigCtrl ($scope, siteConfig, NgTableParams, $filter){

    $scope.changePageHeader('Налаштування ');

    $scope.cols = [
        { title: "ID", headerTitle: "ID", show: true },
        { title: "param", headerTitle: "Параметр", show: true },
        { title: "category", headerTitle: "Категорія", show: true },
        { title: "value", headerTitle: "Значення", show: true },
        { title: "label", headerTitle: "Опис", show: true },
    ];

    $scope.tableParams = new NgTableParams({}, {
        getData: function(params) {
            return siteConfig.list({
                    page: params.page(),
                    pageCount: params.count(),
                })
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    data.rows = params.filter() ? $filter('filter')(data.rows, params.filter()) : data.rows;
                    data.rows = params.sorting() ? $filter('orderBy')(data.rows, params.orderBy()) : data.rows;
                    return data.rows;
                });
        }
    });



}
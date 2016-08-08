/**
 * Created by adm on 08.08.2016.
 */
angular
    .module('teacherApp')
    .controller('modulemanageCtrl',modulemanageCtrl);

function modulemanageCtrl ($scope, $http, DTOptionsBuilder, DTColumnDefBuilder){

    $http.get('/_teacher/_admin/module/getModulesList').then(function (data) {
        $scope.modulesList = data.data["data"];
    });

    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json');

    $scope.dtColumnDefs = [
        DTColumnDefBuilder.newColumnDef(0).withOption('width', '8%'),
        DTColumnDefBuilder.newColumnDef(1).withOption('width', '15%'),
        DTColumnDefBuilder.newColumnDef(2).withOption('width', '8%'),
        DTColumnDefBuilder.newColumnDef(4).withOption('width', '10%'),
        DTColumnDefBuilder.newColumnDef(5).withOption('width', '17%'),
        DTColumnDefBuilder.newColumnDef(6).withOption('width', '10%'),
        DTColumnDefBuilder.newColumnDef(7).withOption('width', '8%'),
    ];

    //initModules();
}

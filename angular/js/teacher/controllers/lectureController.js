/**
 * Created by adm on 08.08.2016.
 */
angular
    .module('teacherApp')
    .controller('lecturesTableCtrl',lecturesTableCtrl)

function lecturesTableCtrl ($scope, $http, DTOptionsBuilder){
    $scope.changePageHeader('Заняття');

    $http.get(basePath+'/_teacher/lecture/getLecturesList').then(function (data) {
        $scope.lectures = data.data["data"];
    });

    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json');
}
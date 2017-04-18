/**
 * Created by adm on 08.08.2016.
 */
angular
    .module('teacherApp')
    .controller('lecturesTableCtrl',lecturesTableCtrl)

function lecturesTableCtrl ($scope, $http, DTOptionsBuilder, $attrs, $state){
    $scope.changePageHeader('Заняття');

    var url = $attrs.organization?basePath+'/_teacher/lecture/getOrganizationLecturesList':basePath+'/_teacher/lecture/getLecturesList';
    $http.get(url).then(function (data) {
        $scope.lectures = data.data["data"];
    });

    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json');

    $scope.reindexContent = function (url) {
        $jq.ajax({
            url: url,
            type: "POST",
            success: function () {
                bootbox.confirm("Операцію успішно виконано.", function () {
                    $state.go("lectures/verifycontent", {}, {reload: true});
                });
            },
            error: function () {
                bootbox.alert("Операцію не вдалося виконати.");
            }
        });
    }
}
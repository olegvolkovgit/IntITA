/**
 * Created by adm on 04.08.2016.
 */
angular
    .module('teacherApp')
    .controller('verifyContentCtrl', verifyContentCtrl);

function verifyContentCtrl($scope, $http, DTOptionsBuilder) {

    $scope.waitLectures = null;
    $scope.verifiedlectures = null;
    
    $http.get(basePath+'/_teacher/_admin/verifyContent/waitLecturesList').then(function (data) {
        $scope.waitLectures = data.data["data"];

    });
    $http.get(basePath+'/_teacher/_admin/verifyContent/verifiedLecturesList').then(function (data) {
        $scope.verifiedlectures = data.data["data"];


    });

    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json');

    $scope.actionLecture = function (action, index, lectureId) {
        if (action === "confirmLecture")
            url = basePath+'/_teacher/_admin/verifyContent/confirm/id/' + lectureId;
        else
            url = basePath+'/_teacher/_admin/verifyContent/cancel/id/' + lectureId;

        bootbox.confirm('Змінити статус лекції?', function (result) {
            if (result) {
                $http.post(url).success(function (data) {
                    if (action === "confirmLecture") {
                        $scope.verifiedlectures.push($scope.waitLectures[index]);
                        $scope.waitLectures.splice(index, 1);
                    }
                    else {
                        $scope.waitLectures.push($scope.verifiedlectures[index]);
                        $scope.verifiedlectures.splice(index, 1);
                    }
                    bootbox.confirm("Операцію успішно виконано.", function () {

                    })
                }).error(function (data) {
                    showDialog("Операцію не вдалося виконати.");
                })
            }
            else {
                showDialog("Операцію відмінено.");
            }
        });

    };

    $scope.reindexContent = function (url) {
        $jq.ajax({
            url: url,
            type: "POST",
            success: function () {
                bootbox.confirm("Операцію успішно виконано.", function () {
                    $scope.changeView('admin/verifycontent');//
                });
            },
            error: function () {
                showDialog("Операцію не вдалося виконати.");
            }
        });
    }
}

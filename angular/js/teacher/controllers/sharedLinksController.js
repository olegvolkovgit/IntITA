/**
 * Created by adm on 10.08.2016.
 */
angular
    .module('teacherApp')
    .controller('sharedlinksCtrl',sharedlinksCtrl);

function sharedlinksCtrl ($scope, $http, DTOptionsBuilder, DTColumnDefBuilder ){

    $http.get(basePath+'/_teacher/_supervisor/shareLink/shareLinksList').then(function (data) {
        $scope.sharedLinksList = data.data["data"];
    });

    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource(basePath + '/scripts/cabinet/Ukranian.json');

    $scope.dtColumnDefs = [
        DTColumnDefBuilder.newColumnDef(0).withOption('width', '30%'),
        DTColumnDefBuilder.newColumnDef(1).withOption('width', '70%'),
    ];

    $scope.deleteSharedLink = function(sharedLinkId){
        bootbox.confirm('Видалити посилання для викладачів?',function(result){
            if (result){
                $http({
                    method: 'POST',
                    url: basePath+'/_teacher/_supervisor/shareLink/delete/',
                    data: $jq.param({'id': sharedLinkId}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                }).success(function(){
                    bootbox.alert("Операцію успішно виконано.",function(){
                        location.hash = '/sharedlinks';
                    });
                }).error(function(){
                    bootbox.alert("Операцію не вдалося виконати.")
                })
            }
            else {
                bootbox.alert("Операцію відмінено.");
            }
        })

    }
}


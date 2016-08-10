/**
 * Created by adm on 10.08.2016.
 */
angular
    .module('teacherApp')
    .controller('responseCtrl',responseCtrl);


function responseCtrl ($scope, $http, DTOptionsBuilder, DTColumnDefBuilder, $state){

    $http.get('/_teacher/_admin/response/getTeacherResponsesList').then(function (data) {
        $scope.responsesList = data.data["data"];
    });

    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource(basePath + '/scripts/cabinet/Ukranian.json');

    $scope.dtColumnDefs = [
        DTColumnDefBuilder.newColumnDef(0).withOption('width', '20%'),
        DTColumnDefBuilder.newColumnDef(1).withOption('width', '20%'),
        DTColumnDefBuilder.newColumnDef(3).withOption('width', '10%'),
        DTColumnDefBuilder.newColumnDef(4).withOption('width', '8%'),
        DTColumnDefBuilder.newColumnDef(5).withOption('width', '15%'),
    ];


    $scope.updateResponse = function(responseId){
        var text = angular.element('#response').fadeIn('fast').bbcode();
        var publish = document.getElementById('Response_is_checked').value;
        $http({
            method: 'POST',
            url: basePath+'/_teacher/_admin/response/updateResponseText/id/'+responseId,
            data: $jq.param({'response': text, 'publish':publish}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
        }).success(function(data){
            bootbox.alert(data, function(){
                location.hash = '#/response/detail/'+responseId;
            });
        }).error(function(data){
            bootbox.alert(data);
        })
    };

       $scope.deleteResponse = function(responseId){
           bootbox.confirm("Видалити відгук?", function (result) {
                if(result){
                    $http({
                        method: 'POST',
                        url: basePath+'/_teacher/_admin/response/delete/id/'+responseId,
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                    }).success(function(data){
                        bootbox.alert('Операцію виконано');
                        location.hash = '#/response';
                    }).error(function (data) {
                        bootbox.alert('Операцію не вдалося виконати.');
                    })
                }
               else {
                    bootbox.alert('Операцію відмінено.')
                }
           })

       };

    $scope.changeResponseStatus = function(responseId,status){
        var url;
        switch (status){
            case 'publish':
                url = basePath + '/_teacher/_admin/response/setpublish/id/'+responseId;
                break;
            case 'hide':
                url = basePath + '/_teacher/_admin/response/unsetpublish/id/'+responseId;
                break
        }
        bootbox.confirm("Змінити статус відгука?", function (result) {
            if(result){
                $http({
                    method: 'POST',
                    url: url,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                }).success(function(data){
                    bootbox.alert("Операцію успішно виконано.",function() {
                        location.reload();
                    })
                }).error(function (data) {
                    bootbox.alert('Операцію не вдалося виконати.');
                })
            }
            else {
                bootbox.alert('Операцію відмінено.')
            }
        })

    };


}

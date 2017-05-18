/**
 * Created by adm on 10.08.2016.
 */
angular
    .module('teacherApp')
    .controller('responseCtrl',responseCtrl)
    .controller('responseModelCtrl',responseModelCtrl);


function responseCtrl ($scope, NgTableParams, responseService){
    $scope.responseStatuses = [{id:null, title:'не перевірено'},{id:'0', title:'приховано'},{id:'1', title:'опубліковано'}];

    $scope.responsesTableParams = new NgTableParams({
        filter:{'is_checked':null},
        sorting: {
            date: 'desc'
        },
    }, {
        getData: function (params) {
            return responseService
                .responsesList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
}

function responseModelCtrl ($scope, $http, $state,$stateParams){
    var url=basePath+'/_teacher/_super_admin/response';
    
    $scope.loadResponse=function(id){
        $http.get(url+'/loadJsonModel/id/'+id).then(function (response) {
            $scope.response = response.data;
        });
    };
    $scope.loadResponse($stateParams.responseId);
    
    $scope.updateResponse = function(responseId){
        var text = angular.element('#response').bbcode();
        var publish = document.getElementById('Response_is_checked').value;
        $http({
            method: 'POST',
            url: url+'/updateResponseText/id/'+responseId,
            data: $jq.param({'response': text, 'publish':publish}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
        }).success(function(data){
            bootbox.alert(data, function(){
                $state.go("response/detail/:responseId", {responseId:responseId}, {reload: true});
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
                    url: url+'/delete/id/'+responseId,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                }).success(function(){
                    bootbox.alert('Операцію виконано', function () {
                        $state.go('response', {}, {reload: true});
                    });
                }).error(function () {
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
                url = basePath + '/_teacher/_super_admin/response/setpublish/id/'+responseId;
                break;
            case 'hide':
                url = basePath + '/_teacher/_super_admin/response/unsetpublish/id/'+responseId;
                break
        }

        $http({
            method: 'POST',
            url: url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
        }).success(function(){
            $scope.loadResponse($stateParams.responseId);
        }).error(function () {
            bootbox.alert('Операцію не вдалося виконати.');
        })

    };
}

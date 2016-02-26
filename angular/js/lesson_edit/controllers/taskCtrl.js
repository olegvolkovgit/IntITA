angular
    .module('lessonEdit')
    .controller('taskCtrl', taskCtrl)

function taskCtrl($scope, $http,getTaskJson,sendTaskJsonService) {

    $scope.getDataTask = function(id) {
        var promise = $http({
            url: basePath+'/task/dataTask',
            method: "POST",
            data: $.param({idBlock: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return response.data;
        }, function errorCallback() {
            return false;
        });
        return promise;
    };
    $scope.getDataTask($scope.idBlock).then(function (response) {
        $scope.dataTask=response;
    });

    $scope.editTaskCKE = function (blockId) {
        editTaskCondition(blockId)
            .then(function(editResponse) {
                if(editResponse){
                    getTaskJson.getJson($scope.task,$scope.interpreterServer).then(function(response){
                        if (response != undefined){
                            $scope.editedJson=response;
                            $scope.editedJson=JSON.parse($scope.editedJson);
                            var tempLang=originLang;
                            $scope.editedJson.lang=selectedLang;
                            sendTaskJsonService.sendJson($scope.interpreterServer,$scope.editedJson).then(function(response){
                                if(!response){
                                    editTaskCondition(blockId, tempLang).then(function() {
                                        $("select#programLang option[value="+"'"+ tempLang +"'"+ "]").attr('selected', 'true');
                                    })
                                }
                            });
                        }
                    });
                }else{
                    bootbox.alert("Зберегти зміни не вдалося. Спробуйте ще раз або зв'яжіться з адміністратором сайту.");
                }
            });
    };

    function editTaskCondition(blockId,lng) {
        lng = typeof lng !== 'undefined' ? lng : selectedLang;
        var promise = $http({
            url: basePath + '/task/editTaskCKE',
            method: "POST",
            data: $.param({idTaskBlock: blockId, condition: $scope.dataTask.condition, lang:lng}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return true;
        }, function errorCallback() {
            return false;
        });
        return promise;
    }

}
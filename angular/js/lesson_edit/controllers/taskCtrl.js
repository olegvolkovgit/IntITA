angular
    .module('lessonEdit')
    .controller('taskCtrl', taskCtrl)

function taskCtrl($scope, $http,getTaskJson,sendTaskJsonService) {

    $scope.getDataTask = function(id) {
        var promise = $http({
            url: basePath+'/revision/dataTaskCondition',
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

    $scope.editTaskCKE = function (blockId, pageId, revisionId,quizType) {
        editTaskCondition(blockId, pageId, revisionId,quizType)
            .then(function(editResponse) {
                if(editResponse){
                    getTaskUID(blockId).then(function(uid) {
                        if (uid) {
                            getTaskJson.getJson(uid, $scope.interpreterServer).then(function (response) {
                                if (response != undefined) {
                                    $scope.editedJson = response;
                                    $scope.editedJson = JSON.parse($scope.editedJson.replace(/\n/g, "\\n"));
                                    var tempLang = originLang;
                                    $scope.editedJson.lang = selectedLang;
                                    sendTaskJsonService.sendJson($scope.interpreterServer, $scope.editedJson).then(function (response) {
                                        if (!response) {
                                            editTaskCondition(blockId, pageId, revisionId, quizType, tempLang).then(function () {
                                                $("select#programLang option[value=" + "'" + tempLang + "'" + "]").attr('selected', 'true');
                                            })
                                        }
                                        bootbox.alert("Зміни умови відбулися", function () {
                                            location.reload();
                                        });
                                    });
                                }
                            });
                        }
                    });
                }else{
                    bootbox.alert("Зберегти зміни не вдалося. Спробуйте ще раз або зв'яжіться з адміністратором сайту.");
                }
            });
    };

    function editTaskCondition(blockId, pageId, revisionId, quizType, lng) {
        lng = typeof lng !== 'undefined' ? lng : selectedLang;
        var promise = $http({
            url: basePath + '/revision/editTest',
            method: "POST",
            data: $.param({revisionId:revisionId,pageId:pageId,
                idBlock: blockId, condition: $scope.dataTask.condition,
                lang:lng, idType:quizType}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return true;
        }, function errorCallback() {
            bootbox.alert("Умову задачі змінити не вдалося");
            return false;
        });
        return promise;
    }

    function getTaskUID(blockId) {
        var promise = $http({
            url: basePath + '/revision/getTaskUIDbyElementId',
            method: "POST",
            data: $.param({blockId:blockId}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            return response.data;
        }, function errorCallback() {
            bootbox.alert("Виникла помилка при редагуванні задачі");
            return false;
        });
        return promise;
    }
}
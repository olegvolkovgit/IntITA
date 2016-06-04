/**
 * Created by Wizlight on 10.12.2015.
 */
angular
    .module('lessonApp')
    .controller('taskCtrl',taskCtrl);

function taskCtrl($rootScope, $http, $timeout, $scope, openDialogsService, pagesUpdateService, userAnswerTaskService, accessLectureService, ipCookie, getTaskJson) {
    $scope.init = function(taskLang)
    {
        $scope.taskLang=taskLang;
        var codeMirrorLang;
        switch ($scope.taskLang) {
            case "js":
                codeMirrorLang="text/javascript";
                break;
            case "php":
                codeMirrorLang="text/x-php";
                break;
            case "c++":
                codeMirrorLang="text/x-c++src";
                break;
            case "c#":
                codeMirrorLang="text/x-csharp";
                break;
            case "java":
                codeMirrorLang="text/x-java";
                break;
        }
        $scope.codeMirrorOptions = {
            lineNumbers: true,
            matchBrackets: true,
            mode: codeMirrorLang,
            theme: "rubyblue",
            indentUnit: 4
        };
        $scope.refreshCodemirror = true;
        $timeout(function () {
            $scope.refreshCodemirror = false;
        }, 100);
    };

    $scope.getVariables=function(id,url){
        if($scope.variables==undefined){
            getTaskJson.getJson(id,url)
                .then(function(variable) {
                    $scope.variables=variable;
                    angular.element('#taskVariables').toggle();
                });
        }else{
            angular.element('#taskVariables').toggle();
        }
    };

    $scope.sendTaskAnswer=function(idTask, taskLang, url,e){
        var jobid=JsUniqid(idTask+'_', false);
        $scope.taskId=idTask;
        var button=angular.element(document.querySelector(".taskSubmit"));
        angular.element(document.querySelector("#ajaxLoad")).css('margin-top', e.currentTarget.offsetTop-20+'px');
        button.attr('disabled', true);

        if($scope.userCode==undefined || $.trim($scope.userCode)=='')
        {
            bootbox.alert('Відповідь не може бути пустою');
            button.removeAttr('disabled');
        } else {
            userAnswerTaskService.sendAnswerJson(url, taskLang, idTask, $scope.userCode, ipCookie("PHPSESSID"), jobid).then(function (response) {
                if(response=='Added to compile'){
                    getTaskResult(idTask);
                }else if(response=='error'){
                    bootbox.alert("На сервері виникли проблеми. Онови сторінку та спробуй ще раз, або зв'яжися з адміністратором.");
                }else{
                    bootbox.alert("Виникла помилка при торимані відповіді. Зв'яжіться з адміністрацією", function () {
                        $('#ajaxLoad').hide();
                    });
                }
                button.removeAttr('disabled');
            });
        }

        function getTaskResult(task) {
            return userAnswerTaskService.getResultJson(url, taskLang, idTask, $scope.userCode, ipCookie("PHPSESSID"), jobid)
                .then(function(serverResponse) {
                    switch (serverResponse.status) {
                        case 'in proccess':
                            getTaskResult();
                            break;
                        case 'done':
                            $('#ajaxLoad').hide();
                            if(serverResponse.done==true){
                                $scope.setMark($scope.taskId, serverResponse.done, serverResponse.date, serverResponse.result, serverResponse.warning)
                                    .then(function(setMarkResponse) {
                                        pagesUpdateService.pagesDataUpdate();
                                        if($rootScope.currentPage==$rootScope.pageData.length){
                                            openDialogsService.openLastTrueDialog();
                                            accessLectureService.getAccessLectures();
                                            $rootScope.finishedLecture = 1;
                                        }else{
                                            openDialogsService.openTrueDialog();
                                        }
                                    });
                            }else if(serverResponse.done==false){
                                $scope.setMark($scope.taskId, serverResponse.done, serverResponse.date, serverResponse.result, serverResponse.warning);
                                var countUnit=serverResponse.testResult.length;
                                var falseUnits=0;
                                for(var i=0;i<countUnit;i++){
                                    if(serverResponse.testResult[i]==false)
                                        falseUnits++;
                                }
                                bootbox.alert('Кількість юніттестів, які не пройшов твій код: '+falseUnits+'/'+serverResponse.testResult.length.toString(), function() {
                                    openDialogsService.openFalseDialog();
                                });
                            } else {
                                bootbox.alert("Твій код не скомпілювався. Виправ помилки та спробуй ще раз.<br>Помилка: <br>"+serverResponse.result);
                            }
                            break;
                        case 'failed':
                            $('#ajaxLoad').hide();
                            bootbox.alert("Твій код не скомпілювався. Виправ помилки та спробуй ще раз.<br>Помилка: <br>"+serverResponse.warning);
                            break;
                        case 'error':
                            $('#ajaxLoad').hide();
                            bootbox.alert("На сервері виникли проблеми. Онови сторінку та спробуй ще раз, або зв'яжися з адміністратором.");
                            break;
                        default:
                            $('#ajaxLoad').hide();
                            bootbox.alert("На сервері виникли проблеми. Онови сторінку та спробуй ще раз, або зв'яжися з адміністратором.");
                    }
                })
        }
    };
    function JsUniqid(pr, en) {
        var pr = pr || '', en = en || false, result, us;

        this.seed = function (s, w) {
            s = parseInt(s, 10).toString(16);
            return w < s.length ? s.slice(s.length - w) :
                (w > s.length) ? new Array(1 + (w - s.length)).join('0') + s : s;
        };

        result = pr + this.seed(parseInt(new Date().getTime() / 1000, 10), 8)
            + this.seed(Math.floor(Math.random() * 0x75bcd15) + 1, 5);

        if (en) result += (Math.random() * 10).toFixed(8).toString();

        return result;
    }

//sent post to intita server to write result
    $scope.setMark=function(task, status, date, result, warning){
        var promise = $http({
            url: basePath + "/task/setMark",
            method: "POST",
            data: $.param({
                task: task,
                status: status,
                date : date,
                result: result,
                warning: warning
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function successCallback(response) {
            return  response.statusText;
        }, function errorCallback() {
            console.log('error setMark');
        });
        return promise;
    };
}
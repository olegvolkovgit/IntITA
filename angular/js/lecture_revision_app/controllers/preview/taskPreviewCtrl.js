/**
 * Created by Wizlight on 10.12.2015.
 */
angular
    .module('lecturePreviewRevisionApp')
    .controller('taskCtrl',taskCtrl);

function taskCtrl($timeout, $scope, taskJson,userAnswerTaskService,ipCookie) {
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
            taskJson.getVariablesTask(id,url)
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
                    bootbox.alert("Задача не містить юніттестів");
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
                                bootbox.alert("<span style='color:green'>Відповідь на тест вірна</span>");
                            } else if(serverResponse.done==false){
                                var countUnit = serverResponse.testResult.length;
                                var falseUnits = 0;
                                for (var i = 0; i < countUnit; i++) {
                                    if (serverResponse.testResult[i] == false)
                                        falseUnits++;
                                }
                                bootbox.alert('Кількість юніттестів, які не пройшов твій код: ' + falseUnits + '/' + serverResponse.testResult.length.toString(), function () {
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
}
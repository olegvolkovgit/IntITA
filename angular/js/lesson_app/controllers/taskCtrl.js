/**
 * Created by Wizlight on 10.12.2015.
 */
angular
    .module('lessonApp')
    .controller('taskCtrl',taskCtrl);

function taskCtrl($rootScope,$http, $scope, accessLectureService,openDialogsService) {
    $scope.sendTaskAnswer=function(idUser, id, task, lang){
        id = "#"+id;
        code = $(id).val();
        if( $.trim(code) == ''){
            alert('Спочатку дайте відповідь на питання');
            return false;
        }
        var command = {
            "operation": "start",
            "session" : "1241q223f4f2341",
            "jobid" : idUser,
            "code" : code,
            "task": task,
            "lang": lang
        };
        var jqxhr = $.post( "http://ii.itatests.com", JSON.stringify(command), function(){
            currentTask = task;
        })
            .done(function(data) {
                $scope.getTaskResult(idUser, code, task, lang);
            })
            .fail(function() {
                alert("Вибачте, на сайті виникла помилка і ми не можемо перевірити Вашу відповідь.\nСпробуйте перезавантажити сторінку або напишіть нам Wizlightdragon@gmail.com.");
                currentTask = 0;
            })
            .always(function() {

            }, "json");
    };

    $scope.getTaskResult=function(idUser, code, task, lang){
        var command = {
            "operation": "result",
            "session" : "1241q223f4f2341",
            "jobid" : idUser,
            "code" : code,
            "task": task,
            "lang": lang
        };
        var jqxhr = $.post( "http://ii.itatests.com", JSON.stringify(command), function(){
        })
            .done(function(data) {
                var serverResponse = jQuery.parseJSON(data);
                $scope.setMark(task, serverResponse.status, serverResponse.date, serverResponse.result, serverResponse.warning);
                currentTask = 0;
                if (serverResponse.status == 'done') {
                    openDialogsService.openTrueDialog();
                    return false;
                } else {
                    openDialogsService.openFalseDialog();
                    return false;
                }
            })
            .fail(function() {
                alert("Вибачте, на сайті виникла помилка і ми не можемо перевірити Вашу відповідь.\nСпробуйте перезавантажити сторінку або напишіть нам Wizlightdragon@gmail.com.");
            })
            .always(function() {

            }, "json");
    };

//sent post to intita server to write result
    $scope.setMark=function(task, status, date, result, warning){
        $.ajax({
            type: "POST",
            url: basePath + "/task/setMark",
            data: {
                'user': idUser,
                'task': task,
                'status': status,
                'date' : date,
                'result': result,
                'warning': warning
            },
            cache: false,
            success: function(){
                location.reload();
            }
        });
    };
}
/**
 * Created by Wizlight on 03.12.2015.
 */
angular
    .module('lessonApp')
    .controller('lectureQuizCtrl',lectureQuizCtrl);

/* Controllers */
function lectureQuizCtrl($rootScope,$http, $scope) {
    //Test Quiz
    $scope.sendTestAnswer=function(block_order,typeButton, test, testType, editMode){
        user=idUser;
        var checkAnswers=angular.element("#answers"+block_order+"  input:"+typeButton+":checked");
        if(checkAnswers.length==0){
            alert('Спочатку виберіть варіант відповіді');
            return false;
        }
        answers = $scope.getUserAnswers(testType);
        $http({
            method: "POST",
            url: basePath + "/tests/checkTestAnswer",
            data: $.param({
                user: user,
                test: test,
                answers: answers,
                testType: testType,
                editMode: editMode
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        })
            .success(function () {
                if (editMode == 0 && user!=0) {
                    $scope.isTrueTestAnswer(user, test);
                }
            })
            .error(function () {
                    alert('error sendTestAnswer');
            })
    };
    $scope.getUserAnswers = function (testType){
        if (testType == 1){
            answer = $('input[name="radioanswer"]:checked').attr("id");
            return answer;
        } else {
            answers = $scope.getMultiplyAnswers();
            return answers;
        }
    };
    $scope.getMultiplyAnswers = function (){
        var answers = $('input[name="checkboxanswer"]:checked');
        var answersValue = [];
        for(var i = 0, l = answers.length; i < l;  i++)
        {
            answersValue.push(answers[i].id);
        }
        return answersValue;
    };
    $scope.isTrueTestAnswer = function (user, test){

        var command = {
            "user": user,
            "test" : test
        };
        var jqxhr = $.post( basePath +"/tests/getTestResult", JSON.stringify(command), function(){})
            .done(function(data) {
                if (data['status'] == '1' && data['lastTest']=='0') {
                    $scope.pageDataUpdate();
                    $scope.openTrueDialog();
                    return false;
                } else if(data['status'] == '1' && data['lastTest']=='1'){
                    $scope.pageDataUpdate();
                    $scope.openLastTrueDialog();
                    return false;
                } else {
                    $scope.openFalseDialog();
                    return false;
                }
            })
            .fail(function() {
                alert("Вибачте, на сайті виникла помилка і ми не можемо перевірити Вашу відповідь.\n" +
                    "Спробуйте перезавантажити сторінку або напишіть нам на адресу Wizlightdragon@gmail.com.");
            })
            .always(function() {
            }, "json");
    };
    //Test Quiz

    //Skip Quiz
    $scope.sendSkipTaskAnswer=function(id){

        var text = skipTaskQuestion.getElementsByTagName('input');
        var answers = [];
        var check = true;
        for(var i = 0; i < text.length;i++)
        {
            if(text[i].value == '')
            {
                check = false;
                alert('Заповніть поле ' + ++i);
            }
        }
        if(!check)
            return check;
        for(var i = 1; i<text.length + 1 ;i++)
        {
            var name = 'skipTask' + i;
            var skipBlock = document.getElementById(name);
            if(skipBlock != undefined){
                var skipText = skipBlock.value;
                var caseInsensitive = skipBlock.getAttribute('caseinsensitive');

                var arr = [];
                arr.push(skipText);
                arr.push(i);
                arr.push(caseInsensitive);

                answers.push(arr);
            }
        }
        var url = basePath + "/skipTask/saveSkipAnswer";
        $http({
            method: "POST",
            url:  url,
            data: $.param({answers: answers, id : id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function(response){
            if (response.data == 'done') {
                $scope.pageDataUpdate();
                $scope.openTrueDialog();
                return false;
            }
            else if(response.data == 'lastPage')
            {
                $scope.pageDataUpdate();
                $scope.openLastTrueDialog();
                return false;
            }
            else if(response.data == 'not done')
            {
                $scope.openFalseDialog();
                return false;
            }
        });
    };
    //Skip Quiz

    // оновлюємо модель з сервера
    $scope.pageDataUpdate = function (){
        $http({
            url: basePath + '/lesson/GetPageData',
            method: "POST",
            data: $.param({lecture: idLecture}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function(response){
            $rootScope.pageData = response.data;
            var count = $rootScope.pageData.length;

            for (var i = 0; i < count; i++) {
                if (i == (count - 1) && $rootScope.pageData[i]['isDone']){
                    $rootScope.lastAccessPage = i+1;
                    break;
                }
                if ($rootScope.pageData[i]['isDone'] && !$rootScope.pageData[i+1]['isDone']){
                    $rootScope.lastAccessPage = i+1;
                    break;
                }
            }
        });
    };
    // оновлюємо модель з сервера
    // Dialog windows
    $scope.openTrueDialog=function(){
        jQuery('#mydialog2').dialog({'width':'540px','height':'auto','modal':true,'autoOpen':false});
        $("#mydialog2").dialog().dialog("open");
        $("#mydialog2").parent().css('border', '4px solid #339900');
    };
    $scope.openLastTrueDialog=function(){
        jQuery('#dialogNextLecture').dialog({'width':'540px','height':'auto','modal':true,'autoOpen':false});
        $("#dialogNextLectureNG").dialog().dialog("open");
        $("#dialogNextLectureNG").parent().css('border', '4px solid #339900');
    };
    $scope.openFalseDialog=function(){
        jQuery('#mydialog3').dialog({'width':'540px','height':'auto','modal':true,'autoOpen':false});
        $("#mydialog3").dialog().dialog("open");
        $("#mydialog3").parent().css('border', '4px solid #cc0000');

    };
    // Dialog windows

    //Task Quiz
    $scope.sendTaskAnswer=function(idUser, id, task, lang){
        id = "#"+id;
        code = $(id).val();
        if( code.trim() == ''){
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
                    $("#mydialog2").dialog("open");
                    $("#mydialog2").parent().css('border', '4px solid #339900');
                    $("#mydialog2").parent().children(".ui-dialog-titlebar").children("button").css('display', 'none');
                    return false;
                } else {
                    $("#mydialog3").dialog("open");
                    $("#mydialog3").parent().css('border', '4px solid #cc0000');
                    $("#mydialog3").parent().children(".ui-dialog-titlebar").children("button").css('display', 'none');
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
    //Task Quiz

    //Plain task Quiz
    $scope.sendPlainTaskAnswer=function(idLecture)
    {
        var answer = $('[name=answer]').val();
        if(answer.trim() == '')
        {
            alert('Спочатку дайте відповідь');
        }
        else
        {
            $http({
                method: "POST",
                url:  basePath + "/plainTask/saveAnswer",
                data: $.param({idLecture:idLecture,answer:answer}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                cache: false
            }).then(function(response){
                alert('Ваша відповідь буде оброблена в найближчий час');
            });
        }

    };
    //Plain task Quiz
}
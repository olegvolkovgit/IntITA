function cancelTest() {
    clearFields();
    location.reload();
}
/*Добавляємо варіант відповіді в список і варіант для вибору цієї відповіді*/
$(document).ready(function () {
    $('html').on('click','.addTest',function () {
        var optionsNum = document.getElementById("optionsNum").value;
        var newOption = 1 + parseInt(optionsNum);
        $('<li><input class="testVariant" type="text" name="option' + newOption + '" id="option' + newOption +'" size="80" required></li>').fadeIn('slow').appendTo('.inputs');

        $('<div><input type="checkbox" name="answer'+ newOption +'" value="'+ newOption +'"></div>').fadeIn('slow').appendTo('.answersCheckbox');

        document.getElementById("optionsNum").value = newOption;
    });
    /*... і видаляємо*/
    $('html').on('click','.removeTest', function () {
        var optionsNum = document.getElementById("optionsNum").value;
        var newOption =parseInt(optionsNum);
        var a = $("#optionsList > li");
        var b = $("#answersList > div");
        a.filter(":last").remove();
        b.filter(":last").remove();
        if(optionsNum>0)
        document.getElementById("optionsNum").value = newOption-1;
    });

    /*Добавляємо варіант відповіді в список і варіант для вибору цієї відповіді при редагуванні*/
    $('html').on('click','.editAddTest',function () {
        var idParent=$(this).parent().attr('id');
        var options = $(this).parent().parent().children('.optionsNum');
        var optionsNum = $(this).parent().parent().children('.optionsNum').val();
        var newOption = 1 + parseInt(optionsNum);
        $('<li><input class="testVariant" type="text" name="option' + newOption + '" id="option' + newOption +'" size="80" required></li>').fadeIn('slow').appendTo('#'+idParent +' > ol');

        $('<div><input type="checkbox" name="answer'+ newOption +'" value="'+ newOption +'"></div>').fadeIn('slow').appendTo('.answersCheckbox');

        options.val(newOption);
    });
    /*... і видаляємо*/
    $('html').on('click','.editRemoveTest', function () {
        var idParent=$(this).parent().attr('id');
        var options = $(this).parent().parent().children('.optionsNum');
        var optionsNum = $(this).parent().parent().children('.optionsNum').val();
        var newOption = parseInt(optionsNum);
        var a = $('#'+idParent+' > ol > li');
        var b = $('.answersCheckbox > div');
        a.filter(":last").remove();
        b.filter(":last").remove();

        if(options.val()>0)
        options.val(newOption-1);
    });
});

function clearFields(){
    document.getElementById("optionsNum").value = 1;
    document.getElementById("option1").value = '';
}

function sendTestAnswer(checkAnswers, user, test, testType, editMode){
    if(checkAnswers.length==0){
        alert('Спочатку виберіть варіант відповіді');
        return false;
    }
    answers = getUserAnswers(testType);
        $.ajax({
            type: "POST",
            url: "/tests/checkTestAnswer",
            data: {
                'user': user,
                'test': test,
                'answers': answers,
                'testType': testType,
                'editMode': editMode
            },
            cache: false,
            success: function () {
                if (editMode == 0 && user!=0) {
                    isTrueTestAnswer(user, test);
                }
            }
        });
}

function getUserAnswers(testType){
    if (testType == 1){
        answer = $('input[name="radioanswer"]:checked').attr("id");
        return answer;
    } else {
        answers = getMultiplyAnswers();
        return answers;
    }
}

function getMultiplyAnswers(){
        var answers = $('input[name="checkboxanswer"]:checked');
        var answersValue = [];
        for(var i = 0, l = answers.length; i < l;  i++)
        {
            answersValue.push(answers[i].id);
        }
    return answersValue;
}

function isTrueTestAnswer(user, test){

        var command = {
            "user": user,
            "test" : test
        };
        var jqxhr = $.post( "/tests/getTestResult", JSON.stringify(command), function(){})
            .done(function(data) {
                if (data['status'] == '1' && data['lastTest']=='0') {
                    jQuery('#mydialog2').dialog({'width':'540px','height':'auto','modal':true,'autoOpen':false});
                    $("#mydialog2").dialog().dialog("open");
                    $("#mydialog2").parent().css('border', '4px solid #339900');
                    return false;
                } else if(data['status'] == '1' && data['lastTest']=='1'){
                    jQuery('#dialogNextLecture').dialog({'width':'540px','height':'auto','modal':true,'autoOpen':false});
                    $("#dialogNextLecture").dialog().dialog("open");
                    $("#dialogNextLecture").parent().css('border', '4px solid #339900');
                    return false;
                } else {
                    jQuery('#mydialog3').dialog({'width':'540px','height':'auto','modal':true,'autoOpen':false});
                    $("#mydialog3").dialog().dialog("open");
                    $("#mydialog3").parent().css('border', '4px solid #cc0000');
                    return false;
                }
            })
            .fail(function() {
                bootbox.alert("Вибачте, на сайті виникла помилка і ми не можемо перевірити Вашу відповідь.\n" +
                    "Спробуйте перезавантажити сторінку або напишіть нам на адресу Wizlightdragon@gmail.com.");
            })
            .always(function() {
            }, "json");
}
/*перевіряємо чи вибраний хоч один варіант відповіді тесту як правильний, якщо ні - інфоповідомлення і неактивна кнопка*/
function checkAnswers(answers){
    var answerTrim = document.getElementsByClassName('testVariant');
    for (var i = 0; i < answerTrim.length; i++) {
        answerTrim[i].value = $.trim(answerTrim[i].value);
        if(answerTrim[i].value==''){
            alert('Варіант відповіді не може містити пустий текст');
            return false;
        }
    }
    if(answers.length==0){
        alert('Виберіть хоч один правильний варіант перед створенням тесту');
        return false;
    }
}
function checkAnswersCKE(answers){
    if($("textarea.testVariant").length<5){
        bootbox.alert("Мінімальна кількість варіантів відповіді не повина бути менше 5");
        return false;
    }
    if($("textarea.testVariant").length>10){
        bootbox.alert("Максимальна кількість варіантів відповіді не повина бути більше 10");
        return false;
    }
    if(answers.length==0){
        bootbox.alert("Виберіть хоч один правильний варіант перед створенням тесту");
        return false;
    }
}

function unableTest(pageId){
    bootbox.confirm('Ви впевнені, що хочете видалити тест?', function(result){
        if(result) {
            $.ajax({
                type: "POST",
                url: "/tests/unableTest",
                data: {'pageId': pageId},
                success: function () {
                    location.reload();
                }
            });
        };
    });
}



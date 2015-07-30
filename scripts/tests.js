function cancelTest() {
    clearFields();
    location.reload();
}

function addOption(){
    optionsNum = document.getElementById("optionsNum").value;

    newOption = 1 + parseInt(optionsNum);
    var newOptionDiv = document.createElement('div');
    newOptionDiv.innerHTML = '<div class="ansnumber">'+newOption + '.</div><input class="testVariant" type="text" name="option' + newOption + '" id="option' + newOption +'" size="80" required/><br>';
    document.getElementById("optionsList").appendChild(newOptionDiv);

    var newAnswerDiv = document.createElement('div');
    newAnswerDiv.innerHTML = '<input type="checkbox" name="answer'+ newOption +'" value="'+ newOption +'">'+ newOption +' відповідь';
    document.getElementById("answersList").appendChild(newAnswerDiv);

    document.getElementById("optionsNum").value = newOption;
}

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
                if (editMode == 0) {
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
    var jqxhr = $.post( "/tests/getTestResult", JSON.stringify(command), function(){

    })
        .done(function(data) {
            if (data['status'] == '1') {
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
            alert("Вибачте, на сайті виникла помилка і ми не можемо перевірити Вашу відповідь.\n" +
            "Спробуйте перезавантажити сторінку або напишіть нам на адресу Wizlightdragon@gmail.com.");
        })
        .always(function() {
        }, "json");
}
function checkAnswers(answers){
    var answerTrim = document.getElementsByClassName('testVariant');
    for (var i = 0; i < answerTrim.length; i++) {
        answerTrim[i].value = $.trim(answerTrim[i].value);
    }
    if(answers.length==0){
        alert('Виберіть хоч один правильний варіант перед створенням тесту');
        document.getElementById("addtests").disabled = true;
    }
}
function buttonEnabled(){
        document.getElementById("addtests").disabled = false;
}



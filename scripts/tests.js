function cancelTest() {
    clearFields();
    location.reload();
}

function addOption(){
    optionsNum = document.getElementById("optionsNum").value;

    newOption = 1 + parseInt(optionsNum);
    var newOptionDiv = document.createElement('div');
    newOptionDiv.innerHTML = newOption + '. <input type="text" name="option' + newOption + '" id="option' + newOption +'" size="80"/><br>';
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

function sendTestAnswer(test, testType){
    answers = getUserAnswers(testType);

    $.ajax({
        type: "POST",
        url: "/IntITA/tests/checkTestAnswer",
        data: {
            'user': idUser,
            'test': test,
            'answers': answers,
            'testType': testType
        },
        cache: false,
        success: function(){
        }
    });
}

function getUserAnswers(testType){
    if (testType == 1){
        answer = $('input[name="radioanswer"]:checked').val();
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
            answersValue.push(answers[i].value);
        }

        return answersValue.join(",");
}


function cancelTest() {
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


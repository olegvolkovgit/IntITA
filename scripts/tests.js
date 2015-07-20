/**
 * Created by Ivanna on 13.07.2015.
 */
function createTest() {
    document.getElementById('addTest').style.display = 'none';
    var name = document.getElementById('name').value;
    var optionsNum = document.getElementById('optionsNum').value;
    var answersNum = document.getElementById('answersNum').value;
    var condition = document.getElementById('condition').value;
    condition = condition.trim();
    var optionsArray = {};
    for (var i = 0; i < optionsNum; i++){
        var id = "option" + i;
        optionsArray[i] = document.getElementById(id).value;
    }

    var answersArray = {};
    for (var j = 0; j < answersNum; j++){
        var idAnswer = "answer" + j;
        optionsArray[j] = document.getElementById(idAnswer).value;
    }

    var newTest = {
        "name": name,
        "condition": condition,
        "options": optionsArray,
        "answers" : answersArray,
        "optionsNum": optionsNum,
        "answersNum": answersNum
    };
    var jqxhr = $.post("/tests/addTest", JSON.stringify(newTest), function () {

    })
        .done(function (data) {
            alert("success");
        })
        .fail(function () {

        })
        .always(function () {
        });
    location.reload();
}

function addTestToLecture(condition, idTeacher, idLecture, lang, id, table) {
    //$.ajax({
    //    type: "POST",
    //    url: "/IntITA/task/addTask",
    //    data: {
    //        'condition': condition,
    //        'author': idTeacher,
    //        'lecture': idLecture,
    //        'language': lang,
    //        'assignment': id,
    //        'table' : table
    //    },
    //    cache: false
    //});
}

function cancelTest() {
    location.reload();
}


/**
 * Created by Ivanna on 13.07.2015.
 */
function createTask() {
    document.getElementById('addTask').style.display = 'none';
    header = document.getElementById('header').value;
    etalon = document.getElementById('etalon').value;
    taskFooter = document.getElementById('taskFooter').value;
    lang = $('select[name="lang"]').val();
    name = document.getElementById('name').value;
    condition = document.getElementById('condition').value;
    condition = condition.trim();
    var newTask = {
        "operation": "addtask",
        "name": name,
        "header": header,
        "etalon": etalon,
        "footer": taskFooter,
        "lang": "c++"
    };
    var jqxhr = $.post("http://ii.itatests.com", JSON.stringify(newTask), function () {
        //alert("success");
    })
        .done(function (data) {
            //alert(data.result);
            addTaskToLecture(condition, idTeacher, idLecture, lang, assignment = 0);
        })
        .fail(function () {
            //alert("Error");
        })
        .always(function () {
            //alert("Finished!");
            addTaskToLecture(condition, idTeacher, idLecture, lang, assignment = 0);
        });
    document.getElementById('addTask').style.display = 'none';
}

function addTaskToLecture() {
    var jqxhr = $.getJSON("http://ii.itatests.com", function () {
        //console.log( "success" );
    })
        .done(function () {
           // console.log("success");
        })
        .fail(function () {
           // console.log("error");
        })
        .always(function () {
          //  console.log("complete");
        });

    $.ajax({
        type: "POST",
        url: "/task/addTask",
        data: {
            'condition': condition,
            'author': idTeacher,
            'lecture': idLecture,
            'language': lang,
            'assignment': 0
        },
        cache: false
    });
}


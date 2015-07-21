/**
 * Created by Ivanna on 13.07.2015.
 */
function createTask() {
    document.getElementById('addTask').style.display = 'none';
    var header = document.getElementById('header').value;
    var etalon = document.getElementById('etalon').value;
    var taskFooter = document.getElementById('taskFooter').value;
    var lang = $('select[name="lang"]').val();
    var name = document.getElementById('name').value;
    var condition = document.getElementById('condition').value;
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

    })
        .done(function (data) {
            var serverResponse = jQuery.parseJSON(data);
            if (serverResponse.status == 'success') {
                addTaskToLecture(condition, idTeacher, idLecture, lang, serverResponse.id, serverResponse.table);
            }
        })
        .fail(function () {
            alert("Error");
            location.reload();
        })
        .always(function () {
        });

}

function addTaskToLecture(condition, idTeacher, idLecture, lang, id, table) {
    $.ajax({
        type: "POST",
        url: "/IntITA/task/addTask",
        data: {
            'condition': condition,
            'author': idTeacher,
            'lecture': idLecture,
            'language': lang,
            'assignment': id,
            'table' : table
        },
        cache: false,
        success: function(){location.reload();
        }
    });
}
function cancelTask() {
    location.reload();
}

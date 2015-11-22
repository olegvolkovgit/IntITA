/**
 * Created by Ivanna on 13.07.2015.
 */
function createTask(url) {
    var header = document.getElementById('header').value;
    var etalon = document.getElementById('etalon').value;
    var taskFooter = document.getElementById('taskFooter').value;
    var condition = document.getElementById('condition').value;

    if(condition.trim()=='' || header.trim()=='' || etalon.trim()=='' || taskFooter.trim()==''){
        alert('Поля з "*" повинні бути заповнені');
        return false;
    }
    document.getElementById('addTask').style.display = 'none';

    var lang = $('select[name="lang"]').val();
    var name = document.getElementById('name').value;
    condition = condition.trim();
    var newTask = {
        "operation": "addtask",
        "name": name,
        "etalon": etalon,
        "lang": "c++",
        "function": {
            "type": 1,
            "results": [[10.0, 12.0]],
            "args":  [
                {
                    "type": 1,
                    "arg_name": "x",
                    "value": [[10.0, 12.0]]
                },
                {
                    "type": 3,
                    "arg_name": "vasya",
                    "value": [["20", "5"]]
                }
            ]
        }
    };
    var jqxhr = $.post(url, JSON.stringify(newTask), function () {
    })
        .done(function (data) {
            var serverResponse = jQuery.parseJSON(data);
            if (serverResponse.status == 'success') {
                addTaskToLecture(condition, idTeacher, idLecture, lang, serverResponse.id, serverResponse.table, task);
            }
        })
        .fail(function () {
            alert("Вибачте, але на сайті виникла помилка і додати задачу до заняття наразі неможливо. " +
            "Спробуйте додати пізніше або зв'яжіться з адміністратором сайту.");
            location.reload();
        })
        .always(function () {
        });

}

function addTaskToLecture(condition, idTeacher, idLecture, lang, id, table, taskType) {
    $.ajax({
        type: "POST",
        url: "/task/addTask",
        data: {
            'condition': condition,
            'author': idTeacher,
            'lecture': idLecture,
            'language': lang,
            'assignment': id,
            'table' : table,
            'taskType' : taskType
        },
        cache: false,
        success: function(){location.reload();
        }
    });
}
function cancelTask() {
    location.reload();
}
function editTask() {
    var header = document.getElementById('header').value;
    var etalon = document.getElementById('etalon').value;
    var taskFooter = document.getElementById('taskFooter').value;
    var condition = document.getElementById('condition').value;

    if(condition.trim()=='' || header.trim()=='' || etalon.trim()=='' || taskFooter.trim()==''){
        alert('Поля з "*" повинні бути заповнені');
        return false;
    }
    document.getElementById('addTask').style.display = 'none';

    var lang = $('select[name="lang"]').val();
    var name = document.getElementById('name').value;
    condition = condition.trim();
    var editTask = {
        "task": 210,
        "lang": "c++",
        "operation": "edittask",
        "name": name,
        "header": header,
        "etalon": etalon,
        "footer": taskFooter
    };
    var jqxhr = $.post("http://ii.itatests.com", JSON.stringify(editTask), function () {
    })
        .done(function (data) {
            var serverResponse = jQuery.parseJSON(data);
            if (serverResponse.status == 'success') {
                editTaskToLecture(condition, idTeacher, idLecture, lang, serverResponse.id, serverResponse.table, task);
            }
        })
        .fail(function () {
            alert("Вибачте, але на сайті виникла помилка і редагувати задачу до заняття наразі неможливо. " +
                "Спробуйте додати пізніше або зв'яжіться з адміністратором сайту.");
            location.reload();
        })
        .always(function () {
        });

}
function editTaskToLecture(condition, idTeacher, idLecture, lang, id, table, taskType) {
    $.ajax({
        type: "POST",
        url: "/task/editTask",
        data: {
            'condition': condition,
            'author': idTeacher,
            'lecture': idLecture,
            'language': lang,
            'assignment': id,
            'table' : table,
            'taskType' : taskType
        },
        cache: false,
        success: function(){location.reload();
        }
    });
}


function unableTask(pageId){
    if (confirm('Ви впевнені, що хочете видалити задачу?')) {
        $.ajax({
            type: "POST",
            url: "/task/unableTask",
            data: {'pageId':pageId},
            success: function(){
                $('div[name="lecturePage"]').html(response);
                return false;
            }
        });
    }
    location.reload();
}


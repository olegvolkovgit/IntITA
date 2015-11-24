/**
 * Created by Ivanna on 13.07.2015.
 */
function createSkipTask(url, pageId) {
    var question = document.getElementById('question').value;
    var condition = document.getElementById('skipTaskCondition').value;

    if(condition.trim()=='' || question.trim()==''){
        alert('Поля з "*" повинні бути заповнені');
        return false;
    }
    document.getElementById('addSkipTask').style.display = 'none';

    $.ajax({
        type: "POST",
        url: url,
        data: {
            "condition": condition,
            "question": question,
            'author': idTeacher,
            'lecture': idLecture,
            'pageId': pageId
        },
        cache: false,
        success: function(data){
            alert(data);
            //location.reload();
        }
    });
}

function cancelSkipTask() {
    location.reload();
}
function editSkipTask() {
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
function editSkipTaskToLecture(condition, idTeacher, idLecture, lang, id, table, taskType) {
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


function unableSkipTask(pageId){
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


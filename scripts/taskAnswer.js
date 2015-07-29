
function sendTaskAnswer(idUser, id, task, lang){
    id = "#"+id;
    code = $(id).val();
    if(code.trim()==''){
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
            getTaskResult(idUser, code, task, lang);
         })
        .fail(function() {
            alert("Вибачте, на сайті виникла помилка і ми не можемо перевірити Вашу відповідь.\nСпробуйте перезавантажити сторінку або напишіть нам Wizlightdragon@gmail.com.");
            currentTask = 0;
        })
        .always(function() {

        }, "json");
}

function getTaskResult(idUser, code, task, lang){
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
            setMark(task, serverResponse.status, serverResponse.date, serverResponse.result, serverResponse.warning);
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
}

//sent post to intita server to write result
function setMark(task, status, date, result, warning){
    $.ajax({
        type: "POST",
        url: "/task/setMark",
        data: {
            'user': idUser,
            'task': task,
            'status': status,
            'date' : date,
            'result': result,
            'warning': warning
        },
        cache: false,
        success: function(){location.reload();
        }
    });
}
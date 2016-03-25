/**
 * Created by Quicks on 10.12.2015.
 */

function removeConsult(id, url, teacher) {
    bootbox.confirm('Ви впевнені що хочете видалити консультанта?', function (result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                data: {id: id, teacher: teacher},
                success: function (respond) {
                    alert(respond);
                    if(respond) {
                        bootbox.alert('Операція успішно виконана.', function () {
                            load(basePath + "/_teacher/teacher/manageConsult", 'Управління консультантами');
                        });
                    } else {
                        bootbox.alert('Операцію не вдалося виконати.');
                    }
                },
                fail: function (){
                    bootbox.alert('Операцію не вдалося виконати.');
                }
            });
        } else {
            bootbox.alert('Операцію відмінено.');
        }
    });
}

function showPlainTaskWithoutTrainer(url) {
    $jq.ajax({
        url: url,
        success: function (data) {
            fillContainer(data);
        }
    })
}

function chooseTrainer(id, url) {
    $jq.ajax({
        url: url,
        data: {id: id},
        success: function (data) {
            fillContainer(data);
        }
    });
}

function sendForm(url) {
    var consult = $jq('#consult').val();
    var idPlainTask = $jq('#idPlainTask').val();

    $jq.ajax({
        url: url,
        type: "POST",
        data: {'consult': consult, 'idPlainTask': idPlainTask},
        success: function (response) {
            if (response == "success") {
                bootbox.alert("Консультант призначений.");
                load(basePath + "/_teacher/teacher/manageConsult", 'Консультанти');
            } else {
                showDialog("Операцію не вдалося виконати.");
            }
        },
        error: function () {
            showDialog("Операцію не вдалося виконати.");
        }
    })
}

function showPlainTaskAnswer(url, idTeacher) {
    $jq.ajax({
        url: url,
        type: "POST",
        data: {'idTeacher': idTeacher},
        success: function (data) {
            fillContainer(data);
            $jq("#pageTitle").html("Задачі до перевірки");
        }
    })
}

function showPlainTask(url, plainTaskId) {
    $jq.ajax({
        url: url,
        type: "POST",
        data: {'idPlainTask': plainTaskId},
        success: function (data) {
            fillContainer(data);
        }
    });
}

function markPlainTask(url) {
    var id = $jq('#plainTaskId').val();
    var mark = $jq('#mark').val();
    var comment = $jq('[name = comment]').val();
    var userId = $jq('#userId').val();
    $jq.ajax({
        url: url,
        type: "POST",
        data: {'idPlainTask': id, 'mark': mark, 'comment': comment, 'userId': userId},
        success: function () {
            showDialog('Ваша оцінка записана в базу');
        },
        error: function () {
            showDialog();
        },
        complete: function () {
            location.reload();
        }
    });

}

function addTrainer(url, scenario) {
    var id = document.getElementById('user').value;
    var trainerId = (scenario == "remove") ? 0 : $jq("#trainer").val();
    var oldTrainerId = (scenario != "new") ? $jq("#oldTrainerId").val() : 0;
    if (trainerId == 0 && scenario != "remove") {
        showDialog("Виберіть тренера.");
    }
    $jq.ajax({
        url: url,
        type: 'post',
        data: {'userId': id, 'trainerId': trainerId, 'oldTrainerId': oldTrainerId},
        success: function (response) {
            if (response == "success") {
                bootbox.alert("Операцію успішно виконано.", function () {
                    load(basePath + "/_teacher/_admin/users/index", 'Користувачі','','4');
                });
            } else {
                showDialog("Операцію не вдалося виконати.");
            }
        },
        error: function () {
            showDialog("Операцію не вдалося виконати.");
        }
    });
}

function removeTrainer(url) {
    if (confirm('Ви впевнені що хочете видалити тренера?')) {
        $jq.ajax({
            url: url,
            success: function (data) {
                location.reload();
            }
        })
    }
}

function fillContainer(data) {
    container = $jq('#pageContainer');
    container.html('');
    container.html(data);
}

function loadUserWithoutTrainer(url) {
    $jq.ajax({
        url: url,
        type: "POST",
        success: function (data) {
            fillContainer(data);
        }
    })
}

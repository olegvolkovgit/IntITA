function load(url, header, histories, tab) {
    clearDashboard();
    showAjaxLoader();
    if (histories == undefined || histories == '') {
        history.pushState({url: url, header: header,tab:tab}, "");
    }
    $jq.ajax({
        url: url,
        async: true,
        success: function (data) {
            container = $jq('#pageContainer');
            container.html('');
            container.html(data);
            if (header) {
                $jq("#pageTitle").text(header);
            } else {
                $jq("#pageTitle").html('Особистий кабінет');
            }
        },
        error: function (data) {
            if(data.status==403){
                bootbox.alert('У вас недостатньо прав для перегляду та редагування сторінки.');
            } else{
                showDialog();
            }
        },
        complete: function(){
            hideAjaxLoader();
        }
    });
}

function cancelTeacherAccess(url,header,redirect) {
        var user = $jq("#user").val();
        var moduleId = $jq("select[name=modules] option:selected").val();

        if(user == 0) {
            bootbox.alert("Виберіть викладача.");
        }else {
            $jq.ajax({
                type: "POST",
                url: url,
                data: {
                    'module': moduleId,
                    'user' : user
                },
                cache: false,
                success: function (data) {
                   if(data == "success"){
                       bootbox.alert("Операцію успішно виконано.");
                   } else {
                       bootbox.alert("Операцію не вдалося виконати.");
                   }
                },
                error:function()
                {
                    bootbox.alert("Операцію не вдалося виконати.");
                }
            });
        }
    }

function reloadPage(event) {
    if (event.state) {
        var path = history.state.url;
        var header = history.state.header;
        load(path, header, true);
    }
}

function setTeacherRole(url) {
    var role = $jq("select[name=role] option:selected").val();
    var teacher = $jq("#teacher").val();
    $jq.ajax({
        url: url,
        type: 'post',
        async: true,
        data: {role: role, teacher: teacher},
        success: function (response) {
            if (response == "success") {
                bootbox.confirm("Операцію успішно виконано.", function () {
                    load(basePath + "/_teacher/_admin/teachers/showTeacher/id/" + teacher, 'Викладач');
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

function cancelTeacherRole(url, role, teacher) {
    bootbox.confirm("Скасувати роль?", function (response) {
        if (response) {
            $jq.ajax({
                url: url,
                type: 'post',
                async: true,
                data: {role: role, teacher: teacher},
                success: function (result) {
                    bootbox.confirm(result, function () {
                        load(basePath + "/_teacher/_admin/teachers/showTeacher/id/" + teacher, "Викладач");
                    });
                },
                error: function () {
                    showDialog("Операцію не вдалося виконати.");
                }

            })
        } else {
            showDialog("Операцію відмінено.");
        }
    });
}

function loadPage(url) {
    $jq.ajax({
        url: url,
        success: function (data) {
            container = $jq('#pageContainer');
            container.html(data);
            $jq("#pageTitle").html("Особистий кабінет");
        },
        error: function () {
            showDialog();
        }
    });
}

function clearDashboard() {
    if (document.getElementById("dashboard"))
        document.getElementById("dashboard").style.display = "none";
}

//Modal windows
function showDialog(str) {
    if (str) {
        $jq('#modalText').html(str);
    }
    $jq('#myModal').modal('show');
}

function send(url) {
    clearDashboard();

    var jsonData = {
        "user": user,
        "subject": document.getElementById("subject"),
        "text": document.getElementById("text"),
        receivers: document.getElementById("receiver")
    };

    $jq.ajax({
        url: url,
        data: jsonData,
        type: 'post',
        success: function (data) {
            container = $jq('#pageContainer');
            container.html('');
            container.html(data);
        },
        error: function () {
            showDialog();
            location.reload();
        }
    });
}

function sendMessage(url) {
    receiver = $jq("#receiverId").val();
    if (receiver == "0") {
        bootbox.alert('Виберіть отримувача повідомлення.');
    } else {
        showAjaxLoader();
        var posting = $jq.post(url,
            {
                "receiver": receiver,
                "subject": $jq("input[name=subject]").val(),
                "text": $jq("#text").val(),
                "scenario": "new"
            }
        );

        posting.done(function (response) {
                if (response == "success") {
                    bootbox.alert("Ваше повідомлення успішно відправлено.", loadMessagesIndex);
                } else {
                    bootbox.alert("Повідомлення не вдалося відправити. Спробуйте надіслати пізніше або " +
                        "напишіть на адресу " + adminEmail, loadMessagesIndex);
                }
            })
            .fail(function () {
                bootbox.alert("Повідомлення не вдалося відправити. Спробуйте надіслати пізніше або " +
                    "напишіть на адресу " + adminEmail, loadMessagesIndex);
            });

        posting.always(function(){
            hideAjaxLoader();
        });
    }
}

function reply(url) {
    var data = {
        "receiver": $jq("input[name=receiver]").val(),
        "parent": $jq("input[name=parent]").val(),
        "subject": $jq("input[name=subject]").val(),
        "text": $jq("#text").val()
    };
    showAjaxLoader();
    var posting = $jq.post(url, data);

    posting.done(function (response) {
            if (response == "success") {
                bootbox.alert("Ваше повідомлення успішно відправлено.", loadMessagesIndex);
            } else {
                bootbox.alert("Повідомлення не вдалося відправити. Спробуйте надіслати пізніше або " +
                    "напишіть на адресу " + adminEmail, loadMessagesIndex);
            }
        })
        .fail(function () {
            bootbox.alert("Повідомлення не вдалося відправити. Спробуйте надіслати пізніше або " +
                "напишіть на адресу " + adminEmail, loadMessagesIndex);
        });
    posting.always(function(){
        hideAjaxLoader();
    });
}

function forward(url) {
    receiver = $jq("#receiverId").val();
    if (receiver == "0") {
        bootbox.alert('Виберіть отримувача повідомлення.');
    } else {
        showAjaxLoader();
        var posting = $jq.post(url,
            {
                "receiver": receiver,
                "subject": $jq("input[name=subject]").val(),
                "parent": $jq("input[name=parent]").val(),
                "forwardToId": $jq("input[name=forwardToId]").val(),
                "text": $jq("#text").val()
            }
        );

        posting.done(function (response) {
                if (response == "success") {
                    bootbox.alert("Ваше повідомлення успішно відправлено.", loadMessagesIndex);
                } else {
                    bootbox.alert("Повідомлення не вдалося відправити. Спробуйте надіслати пізніше або " +
                        "напишіть на адресу " + adminEmail, loadMessagesIndex);
                }
            })
            .fail(function () {
                bootbox.alert("Повідомлення не вдалося відправити. Спробуйте надіслати пізніше або " +
                    "напишіть на адресу " + adminEmail, loadMessagesIndex);
            });
    }
    posting.always(function(){
        hideAjaxLoader();
    });
}

function loadMessagesIndex() {
    window.history.pushState(null, null, basePath + "/cabinet/#");
    load(basePath + "/_teacher/messages/index", 'Листування');
}

function loadForm(url, receiver, scenario, message) {
    idBlock = "#collapse" + message;
    $jq(idBlock).collapse('show');
    id = "#form" + message;
    var command = {
        "user": user,
        "message": message,
        "receiver": receiver,
        "scenario": scenario
    };

    $jq.post(url, {form: JSON.stringify(command)}, function () {
        })
        .done(function (data) {
            $jq(id).empty();
            $jq(id).append(data);
        })
        .fail(function () {
            showDialog();
        })
        .always(function () {
            },
            "json"
        );
}
function showAjaxLoader() {
    var el=document.getElementById('ajaxLoad');
    el.style.top = window.pageYOffset;
    el.style.left = window.pageXOffset;
    el.style.display = "block";
}
function hideAjaxLoader() {
    var el=document.getElementById('ajaxLoad');
    el.style.display = "none";
}
//open tabs by index after load page
function openTab(id, tabIndex){
    if (tabIndex != undefined) {
        $jq(id+' li:eq('+tabIndex+') a').tab('show');
    }
}

function performOperation(url, data, callback){
    showAjaxLoader();
    $jq.ajax({
        type: "POST",
        url: url,
        data: data,
        async: true,
        success: function (response) {
            bootbox.alert(response, callback);
        },
        error:function () {
            bootbox.alert("Операцію не вдалося виконати.");
        },
        complete: function(){
            hideAjaxLoader();
        }
    });
}

function performOperationWithConfirm(url, message, data, callback){
    showAjaxLoader();
    bootbox.confirm(message, function (result) {
        if (result) {
            $jq.ajax({
                type: "POST",
                url: url,
                data: data,
                async: true,
                success: function (response) {
                    bootbox.alert(response, function() {
                        if(!response) bootbox.alert("Операцію успішно виконано.");
                        if(callback) callback();
                    });
                },
                error:function () {
                    bootbox.alert("Операцію не вдалося виконати.");
                },
                complete: function(){
                    hideAjaxLoader();
                }
            });
        } else {
            bootbox.alert("Операцію відмінено.");
            hideAjaxLoader();
        }
    });
}

function initTeacherConsultationsTable(){
    $jq('#consultationsTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_consultant/consultant/getConsultationsList",
            "dataSrc": "data"
        },
        "columns": [
            {"data": "username"},
            {"data": "lecture"},
            {
                type: 'de_date', targets: 1 ,
                "width": "15%",
                "data": "date_cons"
            },
            {
                "width": "15%",
                "data": "start_cons"
            },
            {
                "width": "15%",
                "data": "end_cons"
            },
            {
                "width": "10%",
                "data": "url",
                "render": function (url) {
                    return '<a href="#" onclick="cancelConsultation(\'' + url + '\',\'teacherConsultation\');">Відмінити</a>';
                }
            }
        ],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function initConsultationsTable(){
    $jq('#studentConsultationsTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_student/student/getConsultationsList",
            "dataSrc": "data"
        },
        "columns": [
            {"data": "username"},
            {"data": "lecture"},
            {
                type: 'de_date', targets: 1 ,
                "width": "15%",
                "data": "date_cons"
            },
            {
                "width": "15%",
                "data": "start_cons"
            },
            {
                "width": "15%",
                "data": "end_cons"
            },
            {
                "width": "10%",
                "data": "url",
                "render": function (url) {
                    return '<a href="#" onclick="cancelConsultation(\'' + url + '\',\'studentConsultation\');">Відмінити</a>';
                }
            }
        ],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function cancelConsultation(url,callback) {
    bootbox.confirm('Відмінити консультацію?', function (result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                success: function (response) {
                    if(response == "success") {
                        bootbox.alert("Консультацію відмінено.", function() {
                            if(callback=='studentConsultation')
                                load(basePath + '/_teacher/_student/student/consultations/', 'Консультанції');
                            else if(callback=='teacherConsultation')
                                load(basePath + '/_teacher/_consultant/consultant/consultations/', 'Консультанції')
                        });
                    } else {
                        showDialog("Операцію не вдалося виконати.");
                    }
                },
                error:function () {
                    showDialog("Операцію не вдалося виконати.");
                }
            });
        } else {
            showDialog("Операцію відмінено.");
        }
    });
}


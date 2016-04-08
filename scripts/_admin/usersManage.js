function assignRole(url, role, tab) {
    user = $jq("#userId").val();
    if (user == 0) {
        bootbox.alert('Виберіть користувача.');
    } else {
        var posting = $jq.post(url, {userId: user, role: role});
        posting.done(function (response) {
                bootbox.alert(response, loadUsersIndex(tab));
            })
            .fail(function () {
                bootbox.alert("Користувачу не вдалося призначити обрану роль. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу " + adminEmail, loadUsersIndex);
            });
    }
}

function cancelRole(url, role, user, tab) {
    if (!user) {
        user = $jq("#userId").val();
    }
    if (user == 0) {
        bootbox.alert('Виберіть користувача.');
    } else {
        var posting = $jq.post(url, {userId: user, role: role});
        posting.done(function (response) {
                bootbox.alert(response, loadUsersIndex(tab));
            })
            .fail(function () {
                bootbox.alert("Користувачу не вдалося відмінити обрану роль. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу " + adminEmail, loadUsersIndex(tab));
            });
    }
}

function loadUsersIndex(tab) {
    if (tab == undefined) tab = 0;
    load(basePath + '/_teacher/_admin/users/index', 'Користувачі', '', tab);
}

function initUsersTable() {
    $jq('#usersTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/users/getUsersList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "name"
            },
            {"data": "email"},
            {
                type: 'de_date', targets: 1,
                "width": "15%",
                "data": "register"
            },
            {
                "width": "20%",
                "data": "profile",
                "render": function (url) {
                    return '<a href="' + url + '" target="_blank">Профіль користувача</a>';
                }
            },
            {
                "width": "5%",
                "data": "mailto",
                "render": function (url) {
                    return '<a class="btnChat"  href="' + url + '"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">' +
                        '<i class="fa fa-envelope fa-fw"></i></a>';
                }
            }],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function initTeachersTable() {
    $jq('#teachersTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/users/getTeachersList",
            "dataSrc": "data"
        },
        "columns": [
            {"data": "name"},
            {"data": "email"},
            {
                "width": "20%",
                "data": "profile",
                "render": function (url) {
                    return '<a href="' + url + '" target="_blank">Персональна сторінка</a>';
                }
            },
            {
                "width": "5%",
                "data": "mailto",
                "render": function (url) {
                    return '<a class="btnChat"  href="' + url + '"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">' +
                        '<i class="fa fa-envelope fa-fw"></i></a>';
                }
            }],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function initAdminsTable() {
    $jq('#adminsTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/users/getAdminsList",
            "dataSrc": "data"
        },
        "columns": [
            {"data": "name"},
            {"data": "email"},
            {
                type: 'de_date', targets: 1,
                "width": "15%",
                "data": "register"
            },
            {
                type: 'de_date', targets: 1,
                "width": "15%",
                "data": "cancelDate"
            },
            {
                "width": "10%",
                "data": "profile",
                "render": function (url) {
                    return '<a href="' + url + '" target="_blank">Профіль</a>';
                }
            },
            {
                "width": "5%",
                "data": "mailto",
                "render": function (url) {
                    return '<a class="btnChat"  href="' + url + '"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">' +
                        '<i class="fa fa-envelope fa-fw"></i></a>';
                }
            },
            {
                "width": "5%",
                "data": "cancel",
                "render": function (params) {
                    return '<a href="#" onclick="cancelRole(' + params + ')"><i class="fa fa-trash fa-fw"></i></a>';
                }
            }],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function initAccountantsTable() {
    $jq('#accountantsTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/users/getAccountantsList",
            "dataSrc": "data"
        },
        "columns": [
            {"data": "name"},
            {"data": "email"},
            {
                type: 'de_date', targets: 1,
                "width": "15%",
                "data": "register"
            },
            {
                type: 'de_date', targets: 1,
                "width": "15%",
                "data": "cancelDate"
            },
            {
                "width": "10%",
                "data": "profile",
                "render": function (url) {
                    return '<a href="' + url + '" target="_blank">Профіль</a>';
                }
            },
            {
                "width": "5%",
                "data": "mailto",
                "render": function (url) {
                    return '<a class="btnChat"  href="' + url + '"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">' +
                        '<i class="fa fa-envelope fa-fw"></i></a>';
                }
            },
            {
                "width": "5%",
                "data": "cancel",
                "render": function (params) {
                    return '<a href="#" onclick="cancelRole(' + params + ')"><i class="fa fa-trash fa-fw"></i></a>';
                }
            }],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
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

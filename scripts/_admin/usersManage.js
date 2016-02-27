function sendNewAdminData(url) {
    user = $jq("#typeahead").val();
    if (user === "") {
        bootbox.alert('Виберіть користувача, якого потрібно призначити адміністратором.');
    } else {
        var posting = $jq.post(url, {user: user});
        posting.done(function (response) {
                if (response == 1) {
                    bootbox.alert("Користувач " + user + " призначений адміністратором.", loadUsersIndex);
                }
                else {
                    bootbox.alert("Користувача " + user + " не вдалося призначити адміністратором. Спробуйте повторити " +
                        "операцію пізніше або напишіть на адресу " + adminEmail, loadUsersIndex);
                }
            })
            .fail(function () {
                bootbox.alert("Користувача " + user + " не вдалося призначити адміністратором. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу " + adminEmail, loadUsersIndex);
            });
    }
}

function cancelAdmin(url, id) {
    var posting = $jq.post(url, {user: id});
    posting.done(function (response) {
            if (response == 1)
                bootbox.alert("Права адміністратора для користувача відмінені.", loadUsersIndex);
            else {
                bootbox.alert("Права адміністратора для користувача не вдалося відмінити. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу " + adminEmail, loadUsersIndex);
            }
        })
        .fail(function () {
            bootbox.alert("Права адміністратора для користувача не вдалося відмінити. Спробуйте повторити " +
                "операцію пізніше або напишіть на адресу " + adminEmail, loadUsersIndex);
        });
}

function cancelAccountant(url, id) {
    var posting = $jq.post(url, {user: id});

    posting.done(function (response) {
            if (response == 1)
                bootbox.alert("Права бухгалтера для користувача відмінені.", loadUsersIndex);
            else {
                bootbox.alert("Права бухгалтера для користувача не вдалося відмінити. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу " + adminEmail, loadUsersIndex);
            }
        })
        .fail(function () {
            bootbox.alert("Права бухгалтера для користувача не вдалося відмінити. Спробуйте повторити " +
                "операцію пізніше або напишіть на адресу " + adminEmail, loadUsersIndex);
        });
}

function sendNewAccountantData(url) {
    user = $jq("#typeahead").val();
    if (user === "") {
        bootbox.alert('Виберіть користувача, якого потрібно призначити бухгалтером.');
    } else {
        var posting = $jq.post(url, {user: user});

        posting.done(function (response) {
                if (response == 1)
                    bootbox.alert("Користувач " + user + " призначений бухгалтером.", loadUsersIndex);
                else {
                    bootbox.alert("Користувача " + user + " не вдалося призначити бухгалтером. Спробуйте повторити " +
                        "операцію пізніше або напишіть на адресу " + adminEmail, loadUsersIndex);
                }
            })
            .fail(function () {
                bootbox.alert("Користувача " + user + " не вдалося призначити бухгалтером. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу " + adminEmail, loadUsersIndex);
            });
    }
}

function loadUsersIndex() {
    load(basePath + '/_teacher/_admin/users/index');
}

function initUsersTable() {
    $jq('#usersTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/users/getUsersList",
            "dataSrc": "data"
        },
        "columns": [
            {"data": "name"},
            {"data": "email"},
            {"data": "register"},
            {
                "data": "profile",
                "render": function (url) {
                    return '<a href="' + url + '" target="_blank">Профіль користувача</a>';
                }
            },
            {
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
        },
        dom: "<'row'<'col-sm-6'f><'col-sm-6'l>>"
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
                "data": "profile",
                "render": function (url) {
                    return '<a href="' + url + '" target="_blank">Персональна сторінка</a>';
                }
            },
            {
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
        },
        dom: "<'row'<'col-sm-6'f><'col-sm-6'l>>"
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
            {"data": "register"},
            {"data": "cancelDate"},
            {
                "data": "profile",
                "render": function (url) {
                    return '<a href="' + url + '" target="_blank">Профіль</a>';
                }
            },
            {
                "data": "mailto",
                "render": function (url) {
                    return '<a class="btnChat"  href="' + url + '"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">' +
                        '<i class="fa fa-envelope fa-fw"></i></a>';
                }
            },
            {
                "data": "cancel",
                "render": function (params) {
                    return '<a href="#" onclick="cancelAdmin(' + params + ')"><i class="fa fa-trash fa-fw"></i></a>';
                }
            }],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        },
        dom: "<'row'<'col-sm-6'f><'col-sm-6'l>>"
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
            {"data": "register"},
            {"data": "cancelDate"},
            {
                "data": "profile",
                "render": function (url) {
                    return '<a href="' + url + '" target="_blank">Профіль</a>';
                }
            },
            {
                "data": "mailto",
                "render": function (url) {
                    return '<a class="btnChat"  href="' + url + '"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">' +
                        '<i class="fa fa-envelope fa-fw"></i></a>';
                }
            },
            {
                "data": "cancel",
                "render": function (params) {
                    return '<a href="#" onclick="cancelAccountant(' + params + ')"><i class="fa fa-trash fa-fw"></i></a>';
                }
            }],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        },
        dom: "<'row'<'col-sm-6'f><'col-sm-6'l>>"
    });
}

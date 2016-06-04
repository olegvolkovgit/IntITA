function assignRole(url, role, tab) {
    user = $jq("#userId").val();
    if (user == 0) {
        bootbox.alert('Виберіть користувача.');
    } else {
        var posting = $jq.post(url, {userId: user, role: role});
        posting.done(function (response) {
                bootbox.alert(response, function () {
                    loadUsersIndex(tab);
                });
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

function initCountriesList(){
    $jq('#countriesTable').DataTable({
        "autoWidth": false,
        "order": [[ 0, "asc" ]],
        "ajax": {
            "url": basePath + "/_teacher/_admin/address/getCountriesList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "width": "10%",
                "data": "id"
            },
            {
                "data": "title_ua"
            },
            {
                "data": "title_ru"
            },
            {
                "data": "title_en"
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

function initCitiesList(){
    $jq('#citiesTable').DataTable({
        "autoWidth": false,
        "order": [[ 0, "asc" ]],
        "ajax": {
            "url": basePath + "/_teacher/_admin/address/getCitiesList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "width": "10%",
                "data": "id"
            },
            {
                "data": "country"
            },
            {
                "data": "title_ua"
            },
            {
                "data": "title_ru"
            },
            {
                "data": "title_en"
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

function initUsersTable() {
    $jq('#usersTable').DataTable({
        "autoWidth": false,
        "order": [[ 2, "desc" ]],
        "ajax": {
            "url": basePath + "/_teacher/_admin/users/getUsersList",
            "dataSrc": "data"
        },
        "columns": [
            {
                data: "user",
                "render": function (user) {
                    return '<a href="#" onclick="load(\'' + user["url"] + '\', \'' + user["header"]+ '\');">' + user["name"]+ '</a>';
                }
            },
            {
                data: "email",
                "render": function (email) {
                    return '<a href="#" onclick="load(\'' + email["url"] + '\', \'' + email["header"]+ '\');">' + email["title"]+ '</a>';
                }
            },
            {
                type: 'de_date', targets: 1,
                "width": "12%",
                "data": "register"
            },
            {
                data: "educForm",
                "width": "12%"
            },
            {
                data: "country",
                "width": "10%"
            },
            {
                data: "city",
                "width": "10%"
            },
            {
                "width": "15%",
                "data": "addAccessLink",
                "render": function (link) {
                    return '<button type="button" class="btn btn-outline btn-' + link["color"]+ ' btn-block" onclick="load(' +  link["url"] + ')">' + link["text"]+'</button>';
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

function initConsultantsRolesTable() {
    $jq('#consultantsTable').DataTable({
        "autoWidth": false,
        "order": [[ 3, "desc" ]],
        "ajax": {
            "url": basePath + "/_teacher/_admin/users/getConsultantsList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "name",
                "render": function (name) {
                    return '<a href="#" onclick="load(\'' + name["url"] + '\',  \'' + name["title"] + ' \');">' + name["name"] + '</a>';
                }
            },
            {
                "data": "email",
                "render": function (email) {
                    return '<a href="#" onclick="load(\'' + email["url"] + '\', \'Співробітник\');">' + email["title"] + '</a>';
                }
            },
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

function initTrainersTable() {
    $jq('#trainersTable').DataTable({
        "autoWidth": false,
        "order": [[ 3, "desc" ]],
        "ajax": {
            "url": basePath + "/_teacher/_admin/users/getTrainersList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "name",
                "render": function (name) {
                    return '<a href="#" onclick="load(\'' + name["url"] + '\', \'' + name["title"] + ' \');">' + name["name"] + '</a>';
                }
            },
            {
                "data": "email",
                "render": function (email) {
                    return '<a href="#" onclick="load(\'' + email["url"] + '\', \'Співробітник\');">' + email["title"] + '</a>';
                }
            },
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

function initTeachersTable() {
    $jq('#teachersTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/users/getTeachersList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "name",
                "render": function (name) {
                    return '<a href="#" onclick="load(\'' + name["url"] + '\',  \'' + name["title"] + ' \');">' + name["name"] + '</a>';
                }
            },
            {
                "data": "email",
                "render": function (email) {
                    return '<a href="#" onclick="load(\'' + email["url"] + '\', \'Співробітник\');">' + email["title"] + '</a>';
                }
            },
            {
                "width": "10%",
                "data": "status"
            },
            {
                "width": "10%",
                "data": "changeStatus",
                "render": function (changeStatus) {
                    return '<a href="#" onclick="setTeacherStatus(' +  changeStatus["link"] + ', \'true\')">' +
                        changeStatus["title"] + '</a>';
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
        "order": [[ 3, "desc" ]],
        "ajax": {
            "url": basePath + "/_teacher/_admin/users/getAdminsList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "name",
                "render": function (name) {
                    return '<a href="#" onclick="load(\'' + name["url"] + '\', \'' + name["title"] + '\');">' + name["name"] + '</a>';
                }
            },
            {
                "data": "email",
                "render": function (email) {
                    return '<a href="#" onclick="load(\'' + email["url"] + '\', \'Співробітник\');">' + email["title"] + '</a>';
                }
            },
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
        "order": [[ 3, "desc" ]],
        "ajax": {
            "url": basePath + "/_teacher/_admin/users/getAccountantsList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "name",
                "render": function (name) {
                    return '<a href="#" onclick="load(\'' + name["url"] + '\', \'' + name["title"] + '\');">' + name["name"] + '</a>';
                }
            },
            {
                "data": "email",
                "render": function (email) {
                    return '<a href="#" onclick="load(\'' + email["url"] + '\', \'Співробітник\');">' + email["title"] + '</a>';
                }
            },
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

function addTrainer(url, scenario,header) {
    var id = document.getElementById('user').value;
    var trainerId = (scenario == "remove") ? 0 : $jq("#trainer").val();
    var oldTrainerId = 0;//(scenario != "new") ? $jq("#oldTrainerId").val() : 0;
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
                    load(basePath + "/_teacher/user/index/id/" + id, header);
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

function initContentManagersTable() {
    $jq('#contentManagersTable').DataTable({
        "autoWidth": false,
        "order": [[ 3, "desc" ]],
        "ajax": {
            "url": basePath + "/_teacher/_admin/users/getContentManagersList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "name",
                "render": function (name) {
                    return '<a href="#" onclick="load(\'' + name["url"] + '\', \'' + name["title"] + '\');">' + name["name"] + '</a>';
                }
            },
            {
                "data": "email",
                "render": function (email) {
                    return '<a href="#" onclick="load(\'' + email["url"] + '\', \'Співробітник\');">' + email["title"] + '</a>';
                }
            },
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

function initTeacherConsultantsTable() {
    $jq('#teacherConsultantsTable').DataTable({
        "autoWidth": false,
        "order": [[ 3, "desc" ]],
        "ajax": {
            "url": basePath + "/_teacher/_admin/users/getTeacherConsultantsList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "name",
                "render": function (name) {
                    return '<a href="#" onclick="load(\'' + name["url"] + '\',  \'' + name["title"] + ' \');">' + name["name"] + '</a>';
                }
            },
            {
                "data": "email",
                "render": function (email) {
                    return '<a href="#" onclick="load(\'' + email["url"] + '\', \'Співробітник\');">' + email["title"] + '</a>';
                }
            },
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

function initTenantsTable(){
    $jq('#tenantsTable').DataTable({
        "autoWidth": false,
        "order": [[ 3, "desc" ]],
        "ajax": {
            "url": basePath + "/_teacher/_admin/users/getTenantsList",
            "dataSrc": "data"
        },
        "columns": [
            {"data": "name"},
            {"data": "email"},
            {
                type: 'de_date', targets: 1 ,
                "width": "15%",
                "data": "register"
            },
            {
                type: 'de_date', targets: 1 ,
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

/**
 * Created by anton on 11.02.16.
 */

/**
 * Initialises students table
 */
function initStudentsList() {
    return $jq('#studentsTable').DataTable( {
        "order": [[ 2, "desc" ]],
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/users/getStudentsList",
            "dataSrc": "data"
        },
        "columns": [
            {
                data: "student",
                "render": function (student) {
                    return '<a href="#" onclick="load(\'' + student["url"] + '\', \'' + student["header"]+ '\');">' + student["name"]+ '</a>';
                }
            },
            {
                data: "email",
                "render": function (email) {
                    return '<a href="#" onclick="load(\'' + email["url"] + '\', \'' + email["title"]+ '\');">' + email["title"]+ '</a>';
                }
            },
            {
                "width": "20%",
                data: "date",
                type: 'de_datetime',
                targets: 0
            },
            {
                data: "educForm" ,
                "width": "12%"
            },
            {
                data: "country",
                "width": "10%"
            },
            {
                data: "city",
                "width": "10%"
            },
            {
                "width": "15%",
                "data": "addAccessLink",
                "render": function (link) {
                    return '<button type="button" class="btn btn-outline btn-' + link["color"]+ ' btn-block" onclick="load(' +  link["url"] + ')">' + link["text"]+'</button>';
                }
            }
        ],

        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },

        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    } );
}


/**
 * Updates table data
 * @param startDate
 * @param endDate
 */
function updateStudentList(startDate, endDate) {
    var request = basePath + "/_teacher/_admin/users/getStudentsList";
    if (startDate != null && startDate !== "") {
        request += '?startDate=' + startDate;
        if (endDate != null && endDate !== "") {
            request += '&endDate=' + endDate;
        }
    }
    $jq('#studentsTable').DataTable().ajax.url(request).load();
}





function addTeacherAttrCM(url, attr, id, role) {
    user = $jq('#user').val();
    if (!role) {
        role = $jq('#role').val();
    }
    var value = $jq(id).val();

    if (value == 0) {
        showDialog('Введіть дані форми.');
    }
    if (parseInt(user && value)) {
        $jq.ajax({
            url: url,
            type: "POST",
            async: true,
            data: {user: user, role: role, attribute: attr, attributeValue: value},
            success: function (response) {
                if (response == "success") {
                    bootbox.alert("Операцію успішно виконано.", function () {
                        switch (role) {
                            case "author":
                                loadAuthorModuleListCM(user, 'Інформація про співробітника', 'author');
                                break;
                            case "consultant":
                                loadAuthorModuleListCM(user, 'Інформація про співробітника', 'consultant');
                                break;
                            case "teacher_consultant":
                                loadAuthorModuleListCM(user, 'Інформація про співробітника', 'teacher_consultant');
                                break;
                            default:
                                loadAuthorModuleListCM(user, 'Інформація про співробітника', 'main');
                                break;
                        }
                    });
                } else {
                    switch (role) {
                        case "trainer":
                            showDialog("Для даного студента вже призначено тренера");
                            break;
                        case "author":
                            showDialog("Обраний модуль вже присутній у списку модулів даного викладача");
                            break;
                        case "consultant":
                            showDialog("Консультанту вже призначений даний модуль для консультацій");
                            break;
                        case "teacher_consultant":
                            showDialog("Обраний модуль вже присутній у списку модулів даного викладача");
                            break;
                        default:
                            showDialog("Операцію не вдалося виконати");
                            break;
                    }
                }
            },
            error: function () {
                showDialog("Операцію не вдалося виконати.");
            }
        });
    }
}

function cancelTeacherAccessCM(url) {
    var user = $jq("#user").val();
    var moduleId = $jq("select[name=modules] option:selected").val();

    if (user == 0) {
        bootbox.alert("Виберіть викладача.");
    } else {
        $jq.ajax({
            type: "POST",
            url: url,
            data: {
                'module': moduleId,
                'user': user
            },
            cache: false,
            success: function (data) {
                if (data == "success") {
                    showDialog("Операцію успішно виконано.");
                } else {
                    showDialog("Операцію не вдалося виконати.");
                }
            },
            error: function () {
                showDialog("Операцію не вдалося виконати.");
            }
        });
    }
}

function assignRoleCM(url, role) {
    user = $jq("#userId").val();
    if (user == 0) {
        bootbox.alert('Виберіть користувача.');
    } else {
        var posting = $jq.post(url, {userId: user, role: role});
        posting.done(function (response) {
                bootbox.alert(response, function () {
                    window.history.back();
                });
            })
            .fail(function () {
                bootbox.alert("Користувачу не вдалося призначити обрану роль. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу " + adminEmail, function () {
                    window.history.back();
                });
            });
    }
}

function selectTeacherModules(url, teacher) {
    if (teacher == 0) {
        bootbox.alert("Виберіть викладача.");
    } else {
        $jq.ajax({
            type: "POST",
            url: url,
            data: {teacher: teacher},
            cache: false,
            success: function (response) {
                $jq('div[name="teacherModules"]').html(response);
            }
        });
    }
}

function rejectRevisionRequest(url) {
    bootbox.dialog({
        title: "Ти впевнений, що хочеш відхилити ревізію?",
            message: '<div class="panel-body"><div class="row"><form role="form" name="rejectMessage"><div class="form-group col-md-12">'+
            '<textarea class="form-control" style="resize: none" rows="6" id="rejectMessageText" placeholder="тут можна залишити коментар при відхилені ревізії"></textarea>'+
            '</div></form></div></div>',
            buttons: {success: {label: "Підтвердити", className: "btn btn-primary",
                callback: function () {
                    var comment = $jq('#rejectMessageText').val();
                    $jq.ajax({
                        url: url,
                        data: {comment: comment},
                        type: "POST",
                        success: function (response) {
                            bootbox.alert(response, function () {
                                load(basePath + '/_teacher/_admin/request/index', 'Запити');
                            });
                        },
                        error: function () {
                            bootbox.alert("Операцію не вдалося виконати.");
                        }
                    });
                }
            },
                cancel: {label: "Скасувати", className: "btn btn-default",
                    callback: function () {
                    }
                }
            }
        }
    );
}

function loadTeacherModulesList(id) {
    load(basePath + '/_teacher/_admin/teachers/editRole/id/' + id + '/role/author/', 'Редагувати роль');
}
function loadTrainerStudentList(id) {
    load(basePath + '/_teacher/_admin/teachers/editRole/id/' + id + '/role/trainer/', 'Редагувати роль');
}
function loadAddModuleAuthor() {
    load(basePath + '/_teacher/_admin/permissions/showAddTeacherAccess/');
}
function loadAddModuleConsultant(id) {
    load(basePath + '/_teacher/_admin/teachers/editRole/id/' + id + '/role/consultant/', 'Редагувати роль');
}
function loadModuleEdit(id, header, tab) {
    load(basePath + "/_teacher/_admin/module/update/id/" + id, header, '', tab);
}
function loadAddTeacherAccess(header, tab) {
    load(basePath + "/_teacher/_admin/permissions/index/", header, '', tab);
}
function loadTeacherConsultantList(id) {
    load(basePath + '/_teacher/_admin/teachers/editRole/id/' + id + '/role/teacher_consultant/', 'Редагувати роль');
}
function initTeacherConsultantsTableCM() {
    $jq('#teacherConsultantsTable').DataTable({
        "order": [[3, "desc"]],
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_content_manager/contentManager/getTeacherConsultantsList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "name",
                "render": function (name) {
                    return '<a href="#" onclick="load(\'' + name["url"] + '\', \'Інформація про співробітника\');">' + name["name"] + '</a>';
                }
            },
            {
                "data": "email",
                "render": function (email) {
                    return '<a href="#" onclick="load(\'' + email["url"] + '\', \'Інформація про співробітника\');">' + email["title"] + '</a>';
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
                "width": "15%",
                "data": "cancel",
                "render": function (params) {
                    return '<a href="#" onclick="cancelRoleCM(' + params + ')">скасувати</a>';
                }
            }],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function cancelRoleCM(url, role, user) {
    if (!user) {
        user = $jq("#userId").val();
    }
    if (user == 0) {
        bootbox.alert('Виберіть користувача.');
    } else {
        var posting = $jq.post(url, {userId: user, role: role});
        posting.done(function (response) {
                bootbox.alert(response, function () {
                    load(basePath + '/_teacher/_content_manager/contentManager/dashboard', 'Викладачі-консультанти');
                });
            })
            .fail(function () {
                bootbox.alert("Користувачу не вдалося відмінити обрану роль. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу " + adminEmail);
            });
    }
}

function initAuthorsTableCM() {
    $jq('#authorsTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_content_manager/contentManager/getAuthorsList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "name",
                "render": function (name) {
                    return '<a href="#" onclick="load(\'' + name["url"] + '\', \'Інформація про співробітника\');">' + name["title"] + '</a>';
                }
            },
            {
                "data": "email",
                "render": function (email) {
                    return '<a href="#" onclick="load( \'' + email["url"] + '\', \'Інформація про співробітника\');">' + email["title"] + '</a>';
                }
            }
        ],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function initConsultantsTable() {
    $jq('#consultantsTable').DataTable({
        "autoWidth": false,
        "order": [[3, "desc"]],
        "ajax": {
            "url": basePath + "/_teacher/_content_manager/contentManager/getConsultantsList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "name",
                "render": function (name) {
                    return '<a href="#" onclick="load(\'' + name["url"] + '\', \'Інформація про співробітника\');">' + name["name"] + '</a>';
                }
            },
            {
                "data": "email",
                "render": function (email) {
                    return '<a href="#" onclick="load(\'' + email["url"] + '\', \'Інформація про співробітника\');">' + email["title"] + '</a>';
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
                "width": "15%",
                "data": "cancel",
                "render": function (params) {
                    return '<a href="#" onclick="cancelRoleCM(' + params + ')">скасувати</a>';
                }
            }],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function cancelModuleAttrCM(url, id, attr, role, user) {
    if (!user) {
        user = $jq('#user').val();
    }
    if (!role) {
        role = $jq('#role').val();
    }
    if (user && role) {
        $jq.ajax({
            url: url,
            type: "POST",
            async: true,
            data: {user: user, role: role, attribute: attr, attributeValue: id},
            success: function (response) {
                if (response == "success") {
                    bootbox.alert("Операцію успішно виконано.", function () {
                        switch (role) {
                            case "author":
                                loadAuthorModuleListCM(user, 'Автор модуля', 'author');
                                break;
                            case "consultant":
                                loadAuthorModuleListCM(user, 'Автор модуля', 'consultant');
                                break;
                            case "teacher_consultant":
                                loadAuthorModuleListCM(user, 'Автор модуля', 'teacher_consultant');
                                break;
                            default:
                                loadAuthorModuleListCM(user, 'Автор модуля', 'main');
                                break;
                        }
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
}




function initCoursesListTable(filter_id) {
    if (filter_id == 1) {
        var temp_name = '#statusOfCoursesTableWithoutVideos';
    }
    if (filter_id == 2) {
        var temp_name = '#statusOfCoursesTableWithoutTests';
    }if (filter_id == 3) {
        var temp_name = '#statusOfCoursesTableWithoutTestsAndVideos';
    }if (filter_id == 0) {
        var temp_name = '#statusOfCoursesTable';
    }
    $jq(temp_name).DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_content_manager/contentManager/getCoursesList?filter_id="+filter_id,
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "name",
                "render": function (name) {
                    return '<a href="#" onclick="load(\'' + basePath + '/_teacher/_content_manager/contentManager/StatusOfModules?id=' + name["url"] + '\', \'Модуль\');">' + name["title"] + '</a>';
                }
            },
            {
                type: 'number', targets: 1,
                "data": "module"
            },
            {
                type: 'number', targets: 1,
                "data": "lesson"
            },
            {
                type: 'number', targets: 1,
                "data": "video"
            },
            {
                type: 'number', targets: 1,
                "data": "test"
            },
            {
                type: 'number', targets: 1,
                "data": "part"
            },
            {
                type: 'number', targets: 1,
                "data": "revision"
            }
        ],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": basePath + "/scripts/cabinet/Ukranian.json",
        },
        processing: true,
    });
}

function initAllPhrasesTable() {
    $jq('#allPhrasesTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_tenant/tenant/getAllPhrases",
            "dataSrc": "data"
        },
        "columns": [
            {
                type: 'string', targets: 1,
                "data": "text"
            },
            {

                "data": "id",
                "render": function (id) {
                    return '<a href="#" onclick="load(\'' + basePath + '/_teacher/_tenant/tenant/editPhrase?id=' + id + '\', \'Змінити фразу\');">Змінити</a>';
                }
            }, {

                "data": "id",
                "render": function (id) {
                    return '<a href="#" onclick="load(\'' + basePath + '/_teacher/_tenant/tenant/deletePhrase?id=' + id + '\', \'Видалити фразу\');">Видалити</a>';
                }
            }
        ],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": basePath + "/scripts/cabinet/Ukranian.json",
        },
        processing: true,
    });
}

function initModulesListTable(id,filter_id) {
    if (filter_id == 1) {
        var temp_name = '#statusOfModulesTableWithoutVideos';
    }
    if (filter_id == 2) {
        var temp_name = '#statusOfModulesTableWithoutTests';
    }if (filter_id == 3) {
        var temp_name = '#statusOfModulesTableWithoutTestsAndVideos';
    }if (filter_id == 0) {
        var temp_name = '#statusOfModulesTable';
    }
    $jq(temp_name).DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_content_manager/contentManager/getModulesList?id=" + id+"&filter_id="+filter_id,
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "name",
                "render": function (name) {
                    return '<a href="#" onclick="load(\'' + basePath + '/_teacher/_content_manager/contentManager/showLessonsList?idModule=' + name["url"] + '\', \'Модуль\');">' + name["title"] + '</a>';
                }
            },
            {
                "data": "lesson",
                "render": function (email) {
                    return email["title"];
                }
            },
            {
                type: 'de_date', targets: 1,
                "data": "video"
            },
            {
                type: 'de_date', targets: 1,
                "data": "test"
            },
            {
                type: 'de_date', targets: 1,
                "data": "part"
            },
            {
                type: 'de_date', targets: 1,
                "data": "revision"
            }
        ],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": basePath + "/scripts/cabinet/Ukranian.json",
        },
        processing: true,
    });
}

function initLessonsListTable(idModule) {
    $jq('#statusOfLessonsTable').DataTable({

        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_content_manager/contentManager/getLessonsList?idModule=" + idModule,
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "name",
                "render": function (name) {
                    return '<a href="#" onclick="load(\'' + basePath + '/_teacher/_content_manager/contentManager/showPartsList?idLesson=' + name["url"] + '\', \'Заняття\');">' + name["title"] + '</a>';
                }
            },
            {
                type: 'number', targets: 1,
                "data": "parts"
            },
            {
                type: 'number', targets: 1,
                "data": "video"
            }
            ,
            {
                type: 'number', targets: 1,
                "data": "tests"
            },
            {
                type: 'number', targets: 1,
                "data": "word"
            }
        ],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function initPartsListTable(idLesson) {
    $jq('#statusOfPartsTable').DataTable({

        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_content_manager/contentManager/getPartsList?idLesson=" + idLesson,
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "name",
                "render": function (name) {

                    if(name["alias_module"]===''){
                        if(name["title"]===''){
                            return '<a href="'+basePath+'/module/ua/'+name["id_module"]+'/'+name["lecture_order"]+'/#/page'+name["page_order"]+'" >Переглянути</a>';
                        }else{
                            return '<a href="'+basePath+'/module/ua/'+name["id_module"]+'/'+name["lecture_order"]+'/#/page'+name["page_order"]+'" >' + name["title"] + '</a>';
                        }

                    }else{
                        if(name["title"]===''){
                            return '<a href="'+basePath+'/course/ua/'+name["alias_course"]+'/'+name["alias_module"]+'/'+name["lecture_order"]+'/#/page'+name["page_order"]+'" >Переглянути</a>';
                        }else{
                            return '<a href="'+basePath+'/course/ua/'+name["alias_course"]+'/'+name["alias_module"]+'/'+name["lecture_order"]+'/#/page'+name["page_order"]+'" >' + name["title"] + '</a>';
                        }

                    }

                }
            },
            {
                type: 'number', targets: 1,
                "data": "video"
            }
            ,
            {
                type: 'number', targets: 1,
                "data": "test"
            }
            ,
            {
                type: 'number', targets: 1,
                "data": "word"
            }
        ],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function loadAuthorModuleListCM(id, header, tab) {
    load(basePath + '/_teacher/_content_manager/contentManager/showTeacher/id/' + id, header, '', tab);
}


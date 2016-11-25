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
                    return '<a href="#/content_manager/statusOfModules/'+name["url"]+'">' + name["title"] + '</a>';
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
                    return '<a href="#/detail/lesson/'+name["url"]+'">' + name["title"] + '</a>';
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
                    if(name["title"]===''){
                        return '<a href="'+name["link"]+'#/page'+name["page_order"]+'" target="_blank">Переглянути</a>';
                    }else{
                        return '<a href="'+name["link"]+'#/page'+name["page_order"]+'" target="_blank">' + name["title"] + '</a>';
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


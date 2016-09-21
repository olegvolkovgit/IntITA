function load(url, header, histories, tab) {
    clearDashboard();
    showAjaxLoader();
    if (histories == undefined || histories == '') {
        history.pushState({url: url, header: header, tab: tab}, "");
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
            if (data.status == 403) {
                bootbox.alert('У вас недостатньо прав для перегляду та редагування сторінки.');
            } else {
                showDialog();
            }
        },
        complete: function () {
            hideAjaxLoader();
        }
    });
}

$jq('#deleteModal').on('show.bs.modal', function (e) {
    var messageId = $jq(e.relatedTarget).data('message-id');
    $jq(e.currentTarget).find('input[name="messageId"]').val(messageId);
});

function deleteDialog(url, partner1, partner2) {
    var command = {
        "partner1": partner1,
        "partner2": partner2
    };

    $jq.post(url, {data: JSON.stringify(command)}, function () {
        })
        .done(function () {
            $jq("#deleteDialog").modal("hide");
            bootbox.alert("Діалог успішно видалено.");
            load(basePath + '/_teacher/messages/index', 'Листування');
        })
        .fail(function () {
            bootbox.alert("На сайті виникла помилка.\n" +
                "Спробуйте перезавантажити сторінку або напишіть нам на адресу " + adminEmail);
        })
        .always(function () {
            },
            "json"
        );
}
function editOffer(url, lang) {
    $jq.ajax({
        type: "POST",
        url: url,
        data: {
            lang: lang,
            text: $jq("#offerText").val()
        },
        cache: false,
        success: function (response) {
            bootbox.alert(response, loadTemplateIndex);
        },
        error: function () {
            bootbox.alert('Договір не вдалося створити. Спробуйте пізніше або зверніться до адміністратора ' +
                adminEmail);
        }
    });
}
function loadTemplateIndex() {
    load(basePath + '/_teacher/_accountant/template/index/', 'Шаблони, оферта')
}

function deleteMessage(url, receiver) {
    var command = {
        "message": $jq('input[name="messageId"]').val(),
        "receiver": receiver
    };

    $jq.post(url, {data: JSON.stringify(command)}, function () {
        })
        .done(function () {
            $jq("#deleteModal").modal("hide");
            location.reload();
        })
        .fail(function () {
            showDialog();
            location.reload();
        })
        .always(function () {
            },
            "json"
        );
}

function reset(message) {
    id = "#messageForm" + message;
    $jq(id).remove();
}

function signAgreement(url, course, module, type) {
    schema = $jq('input:radio[name="payment"]:checked').val();
    educationForm = $jq('#educationForm').val();
    if (schema == 0) {
        bootbox.alert("Виберіть схему проплати.");
    } else {
        load(basePath + '/_teacher/_student/student/publicOffer?type=' + type +
            '&course=' + course + '&module=' + module + '&schema=' + schema + '&form=' + educationForm, 'Публічна оферта');
    }
}

function newAgreement(url, type, course, module, schema, educationForm) {
    $jq.ajax({
        type: "POST",
        url: url,
        data: {
            payment: schema,
            course: course,
            educationForm: educationForm,
            module: module,
            type: type
        },
        cache: false,
        success: function (id) {
            if (id != 0) {
                load(basePath + '/_teacher/_student/student/agreement/id/' + id, 'Договір');
            } else {
                bootbox.alert('Договір не вдалося створити. Спробуйте пізніше або зверніться до адміністратора ' +
                    adminEmail);
            }
        },
        error: function () {
            bootbox.alert('Договір не вдалося створити. Спробуйте пізніше або зверніться до адміністратора ' +
                adminEmail);
        }
    });

}

// language data for datapicker
var lang = {
    closeText: 'Закрити',
    prevText: '&#x3C;Попередній',
    nextText: 'Наступний&#x3E;',
    currentText: 'Сьогодні',
    monthNames: ['Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'],
    monthNamesShort: ['Січ', 'Лют', 'Бер', 'Кві', 'Тра', 'Чер',
        'Лип', 'Сер', 'Вер', 'Жов', 'Лис', 'Гру'],
    dayNames: ['неділя', 'понеділок', 'вівторок', 'середа', 'четвер', 'п\'ятниця', 'субота'],
    dayNamesShort: ['нед', 'пон', 'вів', 'сер', 'чет', 'п\'ят', 'сбт'],
    dayNamesMin: ['Нд', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
    weekHeader: 'Тиждень',
    dateFormat: 'yy-mm-dd',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
};

function createAccount(url, course, module, scenario, offerScenario, schema, educationForm) {
    name = 'payment' + educationForm;
    if (!schema) {
        schema = $jq('input:radio[name="' + name + '"]:checked').val();
    }
    if (!educationForm) {
        educationForm = $jq('#educationForm').val();
    }
    if (schema == 0) {
        bootbox.alert("Виберіть схему проплати.");
    } else {
        if (offerScenario != "noOffer") {
            if (1 <= schema <= 8) {
                load(basePath + "/_teacher/_student/student/publicOffer?course=" + course + "&module=" + module +
                    "&type=" + scenario + "&form=" + educationForm + "&schema=" + schema, 'Публічна оферта');
            }
            else {
                bootbox.alert("Неправильно вибрана схема проплати.");
            }
        } else {
            createAgreement(url, schema, course, educationForm, module, scenario);
        }
    }
}

function initActiveRequestsTable() {
    $jq('#activeRequestsTable').DataTable({
        "bDestroy": true,
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/request/getActiveRequestsList",
            "dataSrc": "data"
        },
        "order": [[3, "desc"]],
        "columns": [
            {
                "data": "user",
                "render": function (user) {
                    return '<a href="'+ user["link"]+'" >' + user["title"] + '</a>';
                }
            },
            {
                "width": "30%",
                "data": "module",
                "render": function (module) {
                    return '<a href="'+ module["link"]+'" >' + module["title"] + '</a>';
                }
            },
            {
                "width": "30%",
                "data": "type"
            },
            {
                type: 'de_date', targets: 1,
                "width": "15%",
                "data": "dateCreated"
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

function initApprovedRequestsTable() {
    $jq('#approvedRequestsTable').DataTable({
        "bDestroy": true,
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/request/getApprovedRequestsList",
            "dataSrc": "data"
        },
        "order": [[3, "desc"]],
        "columns": [
            {
                "data": "user",
                "render": function (user) {
                    return '<a href="'+ user["link"]+'" >' + user["title"] + '</a>';
                }
            },
            {
                "width": "30%",
                "data": "module",
                "render": function (module) {
                    return '<a href="'+ module["link"]+'" >' + module["title"] + '</a>';
                }
            },
            {
                "width": "30%",
                "data": "type"
            },
            {
                type: 'de_date', targets: 1,
                "width": "15%",
                "data": "dateCreated"
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

function initDeletedRequestsTable() {
    $jq('#deletedRequestsTable').DataTable({
        "bDestroy": true,
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/request/getDeletedRequestsList",
            "dataSrc": "data"
        },
        "order": [[3, "desc"]],
        "columns": [
            {
                "data": "user",
                "render": function (user) {
                    return '<a href="'+ user["link"]+'" >' + user["title"] + '</a>';
                }
            },
            {
                "width": "30%",
                "data": "module",
                "render": function (module) {
                    return '<a href="'+ module["link"]+'" >' + module["title"] + '</a>';
                }
            },
            {
                "width": "30%",
                "data": "type"
            },
            {
                type: 'de_date', targets: 1,
                "width": "15%",
                "data": "dateCreated"
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

function initRejectedRevisionRequestsTable() {
    $jq('#rejectedRevisionRequestsTable').DataTable({
        "bDestroy": true,
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/request/getRejectedRevisionRequestsList",
            "dataSrc": "data"
        },
        "order": [[3, "desc"]],
        "columns": [
            {
                "data": "user",
                "render": function (user) {
                    return '<a href="'+ user["link"]+'" >' + user["title"] + '</a>';
                }
            },
            {
                "width": "30%",
                "data": "module",
                "render": function (module) {
                    return '<a href="'+ module["link"]+'" >' + module["title"] + '</a>';
                }
            },
            {
                "width": "30%",
                "data": "type"
            },
            {
                type: 'de_date', targets: 1,
                "width": "15%",
                "data": "dateCreated"
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

function createAgreement(url, schema, course, educationForm, module, scenario) {
    data = {
        payment: schema,
        course: course,
        educationForm: educationForm,
        module: module,
        scenario: scenario
    };
    $jq.ajax({
        type: "POST",
        url: url,
        data: data,
        cache: false,
        success: function (response) {
            loadAgreement(response);
        },
        error: function () {
            bootbox.alert('Договір не вдалося створити. Спробуйте пізніше або зверніться до адміністратора ' +
                adminEmail);
        }
    });
}

function initCompanyRepresentatives() {
    $jq('#companyRepresentativesTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_accountant/representative/getCompanyRepresentativesList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "width": "40%",
                "data": "title",
                "render": function (title) {
                    return '<a href="#" onclick="load(\'' + title["url"] + '\',\'Компанія\');" >' + title["name"] + '</a>';
                }
            },
            {
                "width": "20%",
                "data": "position"
            },
            {
                "data": "companies"
            },
            {
                "width": "10%",
                "data": "order"
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

function initRepresentatives() {
    $jq('#representativesTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_accountant/representative/getRepresentativesList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "width": "40%",
                "data": "title",
                "render": function (title) {
                    return '<a href="#" onclick="load(\'' + title["url"] + '\',\'Компанія\');" >' + title["name"] + '</a>';
                }
            },
        ],
        "createdRow": function (row) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function initCompanies() {
    $jq('#companiesTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_accountant/company/getCompaniesList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "title",
                "render": function (title) {
                    return '<a href="#" onclick="load(\'' + title["url"] + '\',\'Компанія\');" >' + title["name"] + '</a>';
                }
            },
            {
                "data": "edrnou",
                "width": "15%",
                "render": function (edrnou) {
                    return '<a href="#" onclick="load(\'' + edrnou["url"] + '\',\'Компанія\');" >' + edrnou["title"] + '</a>';
                }
            },
            {
                "width": "20%",
                "data": "legal_address"
            },
            {
                "width": "20%",
                "data": "actual_address"
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

function addRepresentative(url) {
    var error=false;
    representative = $jq('#representative').val();
    fullName = $jq('[name="full_name"]').val();
    position = $jq('[name="position"]').val();
    company = $jq('#companyId').val();
    order = $jq('[name="order"]').val();
    if (representative == 0 && !(fullName)) {
        bootbox.alert('Виберіть існуючого представника або додайте нового.');
        error=true;
    } if(company==0){
        $jq('#typeaheadCompany').addClass('errorValidation');
        error=true;
    }if(!position){
        $jq('[name="position"]').addClass('errorValidation');
        error=true;
    } if(!order){
        $jq('[name="order"]').addClass('errorValidation');
        error=true;
    }
    if(!error) {
        $jq.ajax({
            type: "POST",
            url: url,
            data: {
                full_name: fullName,
                position: position,
                representative: representative,
                company: company,
                order: order,
            },
            async: true,
            success: function (response) {
                bootbox.alert(response, loadRepresentativeIndex);
            },
            error: function () {
                bootbox.alert("Операцію не вдалося виконати.");
            }
        });
    }
}

function addCompany(url) {

    $jq.ajax({
        type: "POST",
        url: url,
        data: {
            title: $jq('[name="title"]').val(),
            EDPNOU: $jq('[name="edpnou"]').val(),
            certificate_of_vat: $jq('[name="certificate_of_vat"]').val(),
            edpnou_issue_date: $jq('#edpnou_issue_date').val(),
            certificate_of_vat_issue_date: $jq('#certificate_of_vat_issue_date').val(),
            tax_certificate: $jq('[name="tax_certificate"]').val(),
            tax_certificate_issue_date: $jq('#tax_certificate_issue_date').val(),
            legal_address: $jq('[name="legal_address"]').val(),
            legal_address_city_code: $jq('#cityLegal').val(),
            legal_address_city_value: $jq('[name="cityLegal"]').val(),
            actual_address: $jq('[name="actual_address"]').val(),
            actual_address_city_code: $jq('#cityActual').val(),
            actual_address_city_value: $jq('[name="cityActual"]').val()
        },
        async: true,
        success: function (response) {
            bootbox.alert(response, function(response){
                if(response != "Неправильні дані.")
                loadCompanyIndex();
            });
        },
        error: function () {
            bootbox.alert("Операцію не вдалося виконати.");
        }
    });
}

function loadAgreement(id) {
    load(basePath + "/_teacher/_student/student/agreement/id/" + id, 'Договір');
}

function loadCompanyIndex() {
    load(basePath + '/_teacher/_accountant/company/index', 'Компанії');
}

function loadRepresentativeIndex() {
    load(basePath + '/_teacher/_accountant/representative/index', 'Представники');
}

function cancelTeacherAccess(url, header, redirect, role) {
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
                    bootbox.alert("Операцію успішно виконано.", function () {
                        switch (role) {
                            case "author":
                                if (redirect == 'teacherAccess')
                                    loadAddTeacherAccess(header, '1');
                                break;
                            case "consultant":
                                if (redirect == 'teacherAccess')
                                    loadAddTeacherAccess(header, '3');
                                break;
                        }
                    });
                } else {
                    bootbox.alert("Операцію не вдалося виконати.");
                }
            },
            error: function () {
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

function setUserRole(url) {
    var role = $jq("select[name=role] option:selected").val();
    var user = $jq("#user").val();
    $jq.ajax({
        url: url,
        type: 'post',
        async: true,
        data: {role: role, user: user},
        success: function (response) {
            bootbox.confirm(response, function () {
                load(basePath + "/_teacher/user/index/id/" + user, '');
            });
        },
        error: function () {
            showDialog("Операцію не вдалося виконати.");
        }
    });
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
            bootbox.confirm(response, function () {
                load(basePath + "/_teacher/_admin/teachers/showTeacher/id/" + teacher, 'Викладач');
            });
        },
        error: function () {
            showDialog("Операцію не вдалося виконати.");
        }
    });
}

function markPlainTask(url, idTeacher) {
    var id = $jq('#plainTaskId').val();
    var mark = $jq('#mark').val();
    var comment = $jq('[name = comment]').val();
    var userId = $jq('#userId').val();
    $jq.ajax({
        url: url,
        type: "POST",
        data: {'idPlainTask': id, 'mark': mark, 'comment': comment, 'userId': userId},
        success: function () {
            bootbox.alert('Ваша оцінка записана в базу', loadPlainTasksList(idTeacher));
        },
        error: function () {
            showDialog();
        }
    });
}

function loadPlainTasksList(idTeacher) {
    load(basePath + '/_teacher/_teacher_consultant/teacherConsultant/showTeacherPlainTaskList/?idTeacher=' + idTeacher,
        'Задачі до перевірки');
}

function fillContainer(data) {
    container = $jq('#pageContainer');
    container.html('');
    container.html(data);
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

function cancelUserRole(url, role, user, header) {
    bootbox.confirm("Скасувати роль?", function (response) {
        if (response) {
            $jq.ajax({
                url: url,
                type: 'post',
                async: true,
                data: {role: role, user: user},
                success: function (result) {
                    bootbox.confirm(result, function () {
                        load(basePath + "/_teacher/user/index/id/" + user, header);
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


function addStudentAttr(url, user, header, type) {
    value = $jq('#value').val();
    if (type == 'module') {
        module = value;
        course = 0;
    } else if (type == 'course') {
        module = 0;
        course = value;
    }
    if (value != 0) {
        $jq.ajax({
            url: url,
            type: 'post',
            async: true,
            data: {user: user, module: module, course: course},
            success: function (result) {
                bootbox.confirm(result, function () {
                    load(basePath + "/_teacher/user/index/id/" + user, header);
                });
            },
            error: function () {
                showDialog("Операцію не вдалося виконати.");
            }

        })
    } else {
        bootbox.alert('Виберіть курс чи модуль!');
    }
}

function enableAgreeButton() {
    if ($jq('#agree').prop('checked')) {
        $jq('#agreeButton').prop('disabled', false);
    } else {
        $jq('#agreeButton').prop('disabled', true);
    }
}

function back() {
    window.history.back();
}

function changeUserStatus(url, user, message, header, target) {
    bootbox.confirm(message, function (response) {
        if (response) {
            $jq.ajax({
                url: url,
                type: 'post',
                async: true,
                data: {user: user},
                success: function (result) {
                    bootbox.confirm(result, function () {
                        switch(target){
                            case 'showTeacher':
                                load(basePath + "/_teacher/_content_manager/contentManager/showTeacher/id/" + user, header);
                                break;
                            case 'coworkers' :
                                load(basePath + "/_teacher/_admin/teachers/showTeacher/id/" + user, header);
                                break;
                            default :
                                load(basePath + "/_teacher/user/index/id/" + user, header);
                                break;
                        }
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

        posting.always(function () {
            hideAjaxLoader();
        });
    }
}

function loadMessagesIndex() {
    window.history.pushState(null, null, basePath + "/cabinet/#");
    load(basePath + "/_teacher/messages/index", 'Листування');
}

function showAjaxLoader() {
    var el = document.getElementById('ajaxLoad');
    el.style.top = window.pageYOffset;
    el.style.left = window.pageXOffset;
    el.style.display = "block";
}
function hideAjaxLoader() {
    var el = document.getElementById('ajaxLoad');
    el.style.display = "none";
}
//open tabs by index after load page
function openTab(id, tabIndex) {
    if (tabIndex != undefined) {
        $jq(id + ' li:eq(' + tabIndex + ') a').tab('show');
    }
}
//open tabs by index after load page by a href
function openTabByHref(id, href) {
    if (href != undefined) {
        $jq(id + ' a[href="#' + href + '"]').tab('show')
    }
}

function performOperation(url, data, callback) {
    showAjaxLoader();
    $jq.ajax({
        type: "POST",
        url: url,
        data: data,
        async: true,
        success: function (response) {
            bootbox.alert(response, callback);
        },
        error: function () {
            bootbox.alert("Операцію не вдалося виконати.");
        },
        complete: function () {
            hideAjaxLoader();
        }
    });
}

function performOperationWithConfirm(url, message, data, callback) {
    showAjaxLoader();
    bootbox.confirm(message, function (result) {
        if (result) {
            $jq.ajax({
                type: "POST",
                url: url,
                data: data,
                async: true,
                success: function (response) {
                    bootbox.alert(response, function () {
                        if (!response) bootbox.alert("Операцію успішно виконано.");
                        if (callback) callback();
                    });
                },
                error: function () {
                    bootbox.alert("Операцію не вдалося виконати.");
                },
                complete: function () {
                    hideAjaxLoader();
                }
            });
        } else {
            bootbox.alert("Операцію відмінено.");
            hideAjaxLoader();
        }
    });
}

function initPlannedConsultationsTable() {
    $jq('#studentPlannedConsultationsTable').DataTable({
        "autoWidth": false,
        "order": [[2, "asc"], [3, "asc"]],
        "ajax": {
            "url": basePath + "/_teacher/_student/student/getPlannedConsultationsList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "user",
                "width": "20%",
                "render": function (user) {
                    return '<a href="#" onclick="load(\'' + user["url"] + '\',\'Консультація\');" >' + user["name"] + '</a>';
                }
            },
            {
                "data": "lecture",
                "width": "20%",
                "render": function (lecture) {
                    return '<a href="#" onclick="load(\'' + lecture["url"] + '\',\'Консультація\');" >' + lecture["name"] + '</a>';
                }
            },
            {
                type: 'de_date', targets: 1,
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

function initPlannedTeacherConsultationsTable() {
    $jq('#plannedConsultationsTable').DataTable({
        "autoWidth": false,
        "order": [[2, "asc"], [3, "asc"]],
        "ajax": {
            "url": basePath + "/_teacher/_consultant/consultant/getPlannedConsultationsList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "user",
                "width": "20%",
                "render": function (user) {
                    return '<a href="#" onclick="load(\'' + user["url"] + '\',\'Консультація\');" >' + user["name"] + '</a>';
                }
            },
            {
                "data": "lecture",
                "width": "20%",
                "render": function (lecture) {
                    return '<a href="#" onclick="load(\'' + lecture["url"] + '\',\'Консультація\');" >' + lecture["name"] + '</a>';
                }
            },
            {
                type: 'de_date', targets: 1,
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

function initPastTeacherConsultationsTable() {
    $jq('#pastConsultationsTable').DataTable({
        "autoWidth": false,
        "order": [[2, "desc"], [3, "desc"]],
        "ajax": {
            "url": basePath + "/_teacher/_consultant/consultant/getPastConsultationsList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "user",
                "width": "20%",
                "render": function (user) {
                    return '<a href="#" onclick="load(\'' + user["url"] + '\',\'Консультація\');" >' + user["name"] + '</a>';
                }
            },
            {
                "data": "lecture",
                "width": "20%",
                "render": function (lecture) {
                    return '<a href="#" onclick="load(\'' + lecture["url"] + '\',\'Консультація\');" >' + lecture["name"] + '</a>';
                }
            },
            {
                type: 'de_date', targets: 1,
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

function initCancelTeacherConsultationsTable() {
    $jq('#cancelConsultationsTable').DataTable({
        "autoWidth": false,
        "order": [[2, "desc"]],
        "ajax": {
            "url": basePath + "/_teacher/_consultant/consultant/getCancelConsultationsList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "user",
                "width": "20%",
                "render": function (user) {
                    return '<a href="#" onclick="load(\'' + user["url"] + '\',\'Консультація\');" >' + user["name"] + '</a>';
                }
            },
            {
                "data": "lecture",
                "width": "20%",
                "render": function (lecture) {
                    return '<a href="#" onclick="load(\'' + lecture["url"] + '\',\'Консультація\');" >' + lecture["name"] + '</a>';
                }
            },
            {
                type: 'de_date', targets: 1,
                "width": "15%",
                "data": "date_cons"
            },
            {
                "width": "15%",
                "data": "user_cancelled"
            },
            {
                "width": "15%",
                "data": "date_cancelled"
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

function initCancelConsultationsTable() {
    $jq('#studentCancelConsultationsTable').DataTable({
        "autoWidth": false,
        "order": [[2, "desc"]],
        "ajax": {
            "url": basePath + "/_teacher/_student/student/getCancelConsultationsList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "user",
                "width": "20%",
                "render": function (user) {
                    return '<a href="#" onclick="load(\'' + user["url"] + '\',\'Консультація\');" >' + user["name"] + '</a>';
                }
            },
            {
                "data": "lecture",
                "width": "20%",
                "render": function (lecture) {
                    return '<a href="#" onclick="load(\'' + lecture["url"] + '\',\'Консультація\');" >' + lecture["name"] + '</a>';
                }
            },
            {
                type: 'de_date', targets: 1,
                "width": "15%",
                "data": "date_cons"
            },
            {
                "width": "15%",
                "data": "user_cancelled"
            },
            {
                "width": "15%",
                "data": "date_cancelled"
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

function initPastConsultationsTable() {
    $jq('#studentPastConsultationsTable').DataTable({
        "autoWidth": false,
        "order": [[2, "desc"], [3, "desc"]],
        "ajax": {
            "url": basePath + "/_teacher/_student/student/getPastConsultationsList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "user",
                "width": "20%",
                "render": function (user) {
                    return '<a href="#" onclick="load(\'' + user["url"] + '\',\'Консультація\');" >' + user["name"] + '</a>';
                }
            },
            {
                "data": "lecture",
                "width": "20%",
                "render": function (lecture) {
                    return '<a href="#" onclick="load(\'' + lecture["url"] + '\',\'Консультація\');" >' + lecture["name"] + '</a>';
                }
            },
            {
                type: 'de_date', targets: 1,
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

function initTodayTeacherConsultationsTable() {
    $jq('#todayConsultationsTable').DataTable({
        "autoWidth": false,
        "order": [[2, "asc"], [3, "asc"]],
        "ajax": {
            "url": basePath + "/_teacher/_consultant/consultant/getTodayConsultationsList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "user",
                "width": "20%",
                "render": function (user) {
                    return '<a href="#" onclick="load(\'' + user["url"] + '\',\'Консультація\');" >' + user["name"] + '</a>';
                }
            },
            {
                "data": "lecture",
                "width": "20%",
                "render": function (lecture) {
                    return '<a href="#" onclick="load(\'' + lecture["url"] + '\',\'Консультація\');" >' + lecture["name"] + '</a>';
                }
            },
            {
                type: 'de_date', targets: 1,
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
                "data": "start",
                "render": function (start) {
                    switch(start["status"]){
                        case 'ended':
                            return 'закінчена';
                        case 'started':
                            return '<a type="button" class="btn btn-success btn-sm" href="' + start["link"] + '" target="_blank">почати</a>';
                        case 'wait':
                            return 'очікування';
                    }
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

function initTodayConsultationsTable() {
    $jq('#studentTodayConsultationsTable').DataTable({
        destroy: true,
        "autoWidth": false,
        "order": [[2, "asc"], [3, "asc"]],
        "ajax": {
            "url": basePath + "/_teacher/_student/student/getTodayConsultationsList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "user",
                "width": "20%",
                "render": function (user) {
                    if(user["url"]) return '<a href="#" onclick="load(\'' + user["url"] + '\',\'Консультація\');" >' + user["name"] + '</a>';
                    else return user["name"];
                }
            },
            {
                "data": "lecture",
                "width": "20%",
                "render": function (lecture) {
                    if(lecture["url"]) return '<a href="#" onclick="load(\'' + lecture["url"] + '\',\'Консультація\');" >' + lecture["name"] + '</a>';
                    else  return lecture["name"];
                }
            },
            {
                type: 'de_date', targets: 1,
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
                "data": "start",
                "render": function (start) {
                    switch(start["status"]){
                        case 'false':
                            return '';
                        case 'ended':
                            return 'закінчена';
                        case 'started':
                            return '<a type="button" class="btn btn-success btn-sm" href="' + start["link"] + '" target="_blank">почати</a>';
                        case 'wait':
                            return 'очікування'; 
                    }
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

function selectMandatoryModule(url) {
    var course = $jq('select[name="course"]').val();
    $jq.ajax({
        type: "POST",
        url: url,
        data: {course: course},
        cache: false,
        success: function (response) {
            $('div[name="selectModule"]').html(response);
        }
    });
}

function selectModule(url) {
    var course = $('select[name="course"]').val();
    if (!course) {
        $('div[name="selectModule"]').html('');
        $('div[name="selectLecture"]').html('');
    } else {
        $.ajax({
            type: "POST",
            url: url,
            data: {course: course},
            cache: false,
            success: function (response) {
                $('div[name="selectModule"]').html(response);
            }
        });
    }
}

function newPermissions(url) {
    var rights = [];
    $("input[name='permission[]']:checked").each(function () {
        rights.push($(this).val());
    });
    var moduleId = $("select[name=module] option:selected").val();
    var userId = $("select[name=user] option:selected").val();

    if (rights.length == 0) {
        showDialog('Виберіть права для користувача');
        return false;
    }

    if (moduleId && userId && rights) {
        $.ajax({
            type: "POST",
            url: url,
            data: {
                'module': moduleId,
                'user': userId,
                'rights': rights
            },
            cache: false,
            success: function (data) {
                fillContainer(data);
            },
            error: function (data) {
                showDialog();
            }
        });
    }
    else
        showDialog('Введенні невірні дані!');
}

function toEnglish(name) {
    var english = {
        "А": "A",
        "а": "a",
        "Б": "B",
        "б": "b",
        "В": "V",
        "в": "v",
        "Г": "H",
        "г": "h",
        "Ґ": "G",
        "ґ": "g",
        "Д": "D",
        "д": "d",
        "Е": "E",
        "е": "e",
        "Є": "Ye",
        "є": "ie",
        "Ж": "Zh",
        "ж": "zh",
        "З": "Z",
        "з": "z",
        "И": "Y",
        "и": "y",
        "І": "I",
        "і": "i",
        "Ї": "Yi",
        "ї": "i",
        "Й": "Y",
        "й": "i",
        "К": "K",
        "к": "k",
        "Л": "L",
        "л": "l",
        "М": "M",
        "м": "m",
        "Н": "N",
        "н": "n",
        "О": "O",
        "о": "o",
        "П": "P",
        "п": "p",
        "Р": "R",
        "р": "r",
        "С": "S",
        "с": "s",
        "Т": "T",
        "т": "t",
        "У": "U",
        "у": "u",
        "Ф": "F",
        "ф": "f",
        "Х": "Kh",
        "х": "kh",
        "Ц": "Ts",
        "ц": "ts",
        "Ч": "Ch",
        "ч": "ch",
        "Ш": "Sh",
        "ш": "sh",
        "Щ": "Shch",
        "щ": "shch",
        "Ю": "Yu",
        "ю": "iu",
        "Я": "Ya",
        "я": "ia",
        "Ь": "",
        "ь": "",
        "-": "-",
        " ": " "

    };
    result = name.split("");
    var newName = '';
    result.forEach(function (item, i, result) {
        if (item != undefined) {
            if (english[item] == undefined) return;
            newName = newName + english[item];
        }
    });
    return newName;
}


function loadCancelAuthorModule() {
    load(basePath + '/_teacher/_admin/permissions/showCancelTeacherAccess/');
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

function checkMandatory() {
    var course = $jq('select[name="course"]').val();
    var module = $jq('select[name="mandatory"]').val();

    if (course && module)
        return true;
    else {
        $jq('.errorMessage').html('Поле не може бути пустим');
        return false;
    }
}

function initInvoicesTable(id) {
    $jq('#invoicesTable').DataTable({
        "autoWidth": false,
        "order": [[2, "asc"]],
        "ajax": {
            "url": basePath + "/_teacher/_student/student/getInvoicesByAgreement",
            "dataSrc": "data",
            "data": {id: id}
        },
        "columns": [
            {
                "data": "title",
                "render": function (title) {
                    return '<a href="' + title["url"] + '">' + title["name"] + '</a>';
                }
            },
            {"data": "summa"},
            {
                type: 'de_date', targets: 1,
                "width": "15%",
                "data": "date"
            },
            {
                "width": "15%",
                "data": "url",
                "render": function (url) {
                    return '<a href="' + url + '">надрукувати</a>';
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

function initConsultationsTable() {
    $jq('#studentConsultationsTable').DataTable({
        "autoWidth": false,
        "order": [[2, "desc"], [3, "desc"]],
        "ajax": {
            "url": basePath + "/_teacher/_student/student/getConsultationsList",
            "dataSrc": "data"
        },
        "columns": [
            {"data": "username"},
            {"data": "lecture"},
            {
                type: 'de_date', targets: 1,
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
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function cancelConsultation(url, callback) {
    bootbox.confirm('Відмінити консультацію?', function (result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                success: function (response) {
                    if (response == "success") {
                        bootbox.alert("Консультацію відмінено.", function () {
                            if (callback == 'studentConsultation')
                                load(basePath + '/_teacher/_student/student/consultations/', 'Консультанції');
                            else if (callback == 'teacherConsultation')
                                load(basePath + '/_teacher/_consultant/consultant/consultations/', 'Консультанції')
                        });
                    } else {
                        showDialog("Операцію не вдалося виконати.");
                    }
                },
                error: function () {
                    showDialog("Операцію не вдалося виконати.");
                }
            });
        } else {
            showDialog("Операцію відмінено.");
        }
    });
}

function initPayCoursesList() {
    $jq('#payCoursesTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_student/student/getPayCoursesList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "title",
                "render": function (title) {
                    if(title["url"]=='')
                        return title["name"];
                    else return '<a href="' + title["url"] + '">' + title["name"] + '</a>';
                }
            },
            //{
            //    type: 'de_date', targets: 1,
            //    "width": "15%",
            //    "data": "date"
            //},
            {"data": "summa"}
            //{
            //    "width": "15%",
            //    "data": "agreement"
            //}
        ],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function initPayModulesTable() {
    $jq('#payModulesTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_student/student/getPayModulesList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "title",
                "render": function (title) {
                    if(title["url"]=='')
                        return title["name"];
                    else return '<a href="' + title["url"] + '">' + title["name"] + '</a>';
                }
            },
            //{
            //    type: 'de_date', targets: 1,
            //    "width": "15%",
            //    "data": "date"
            //},
            {"data": "summa"}
            //{
            //    "width": "15%",
            //    "data": "agreement"
            //}
        ],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function initAgreementsTable() {
    $jq('#agreementsTable').DataTable({
        "autoWidth": false,
        "order": [[2, "asc"]],
        "ajax": {
            "url": basePath + "/_teacher/_student/student/getAgreementsList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "title",
                "width": "20%",
                "render": function (title) {
                    return '<a href="#" onclick="load(' + title["url"] + ',\'' + title["name"] + '\');" >' + title["name"] + '</a>';
                }
            },
            {
                "data": "object"
            },
            {
                "data": "schema",
                "width": "25%"
            },
            {
                type: 'de_date', targets: 1,
                "width": "10%",
                "data": "date"
            },
            {
                "data": "summa",
                "width": "12%"
            },
            {
                "width": "10%",
                "data": "invoices",
                "render": function (invoices) {
                    return '<a href="#" onclick="load(' + invoices["url"] + ',\'' + invoices["name"] + '\');">рахунки</a>';
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

function addCountry(url) {
    titleUa = $jq('[name="titleUa"]').val();
    titleRu = $jq('[name="titleRu"]').val();
    titleEn = $jq('[name="titleEn"]').val();
    geocode = $jq('[name="geocode"]').val();

    $jq.ajax({
        type: "POST",
        url: url,
        data: {
            titleUa: titleUa,
            titleRu: titleRu,
            titleEn: titleEn,
            geocode: geocode
        },
        async: true,
        success: function (response) {
            bootbox.alert(response, load(basePath + '/_teacher/_admin/address/index', 'Країни, міста'));
        },
        error: function () {
            bootbox.alert("Операцію не вдалося виконати.");
        }
    });
}

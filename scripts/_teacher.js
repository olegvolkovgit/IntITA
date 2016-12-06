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

function reloadPage(event) {
    if (event.state) {
        var path = history.state.url;
        var header = history.state.header;
        load(path, header, true);
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

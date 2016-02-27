function initTeacherResponsesTable() {
    $jq('#teacherResponsesTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/response/getTeacherResponsesList",
            "dataSrc": "data"
        },
        "columns": [
            {"data": "author"},
            {"data": "about"},
            {"data": "date"},
            {"data": "text"},
            {"data": "rate"},
            {"data": "publish"},
            {
                "data": "linkChangeStatus",
                "render": function (url) {
                    return '<a href="#" onclick="setResponseStatus(' + url + ')"><i class="fa fa-refresh"></i></a>';
                }
            },
            {
                "data": "linkView",
                "render": function (linkView) {
                    return '<a href="#" onclick="load(' + linkView + ')"><i class="fa fa-eye"></i></a>';
                }
            },
            {
                "data": "linkEdit",
                "render": function (linkEdit) {
                    return '<a href="#" onclick="load(' + linkEdit + ')"><i class="fa fa-pencil"></i></a>';
                }
            },
            {
                "data": "linkDelete",
                "render": function (linkDelete) {
                    return '<a href="#" onclick="deleteResponse(' + linkDelete + ')"><i class="fa fa-trash"></i></a>';
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

function setResponseStatus(url) {
    bootbox.confirm("Змінити статус відгука?", function (result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                success: function () {
                    bootbox.confirm("Операцію успішно виконано.", function () {
                        load(basePath + "/_teacher/_admin/response/index");
                    });
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

function deleteResponse(url) {
    bootbox.confirm("Видалити відгук?", function (result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                success: function () {
                    bootbox.confirm("Операцію успішно виконано.", function () {
                        load(basePath + "/_teacher/_admin/response/index");
                    });
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
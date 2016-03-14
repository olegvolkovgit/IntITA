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
            {
                type: 'de_date', targets: 1 ,
                "width": "10%",
                "data": "date"},
            {"data": "text"},
            {
                "width": "8%",
                "data": "rate"},
            {
                "width": "12%",
                "data": "publish"},
            {
                "width": "5%",
                "data": "linkChangeStatus",
                "render": function (url) {
                    return '<a href="#" onclick="setResponseStatus(' + url + ')"><i class="fa fa-refresh"></i></a>';
                }
            },
            {
                "width": "5%",
                "data": "linkView",
                "render": function (linkView) {
                    return '<a href="#" onclick="load(' + linkView + ')"><i class="fa fa-eye"></i></a>';
                }
            },
            {
                "width": "5%",
                "data": "linkEdit",
                "render": function (linkEdit) {
                    return '<a href="#" onclick="load(' + linkEdit + ')"><i class="fa fa-pencil"></i></a>';
                }
            },
            {
                "width": "5%",
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
        }
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
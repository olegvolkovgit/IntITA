function initTeacherResponsesTable() {
    $jq('#teacherResponsesTable').DataTable({
        "order": [[ 3, "desc" ]],
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/response/getTeacherResponsesList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "width": "20%",
                "data": "author"},
            {   "width": "20%",
                "data": "about"
            },
            {
                "data": "response",
                "render": function (response) {
                    return '<a href="#" onclick="load(' + response["link"] + ')">' + response["text"]+'</a>';
                }
            },
            {
                type: 'de_date', targets: 1 ,
                "width": "10%",
                "data": "date"},
            {
                "width": "8%",
                "data": "rate"},
            {
                "width": "15%",
                "data": "publish"
            }],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
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

function _deleteResponse(url) {
    bootbox.confirm("Видалити відгук?", function (result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                success: function () {
                    bootbox.confirm("Операцію успішно виконано.", function () {
                        load(basePath + "/_teacher/_admin/response/index",'Відгуки про викладачів',true);
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
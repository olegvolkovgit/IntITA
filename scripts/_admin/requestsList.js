function initRequestsTable() {
    $jq('#teacherResponsesTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/request/getRequestList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "width": "30%",
                "data": "user"
            },
            {
                "width": "50%",
                "data": "module",
                "render": function (module) {
                    return '<a href="#" onclick="load(' + module["link"] + ')">' + module["title"] + '</a>';
                }
            },
            {
                "width": "20%",
                "data": "type"
            },
            {
                "width": "20%",
                "data": "dateCreated"
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


function setRequestStatus(url, message) {
    bootbox.confirm(message, function (result) {
        if (result) {
            $jq.ajax({
                url: url,
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
        } else {
            bootbox.alert("Операцію відмінено.");
        }
    });
}

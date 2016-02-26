function initShareLinks() {
    $jq('#shareLinksTable').DataTable({
        "ajax": {
            "url": basePath + "/_teacher/_admin/shareLink/shareLinksList",
            "dataSrc": "data"
        },
        "columns": [
            {"data": "name"},
            {"data": "link"},
            {
                "data": "linkView",
                "render": function (url) {
                    return '<a href="#" onclick="load(' + url + ')"><i class="fa fa-eye"></i></a>';
                }
            },
            {
                "data": "linkEdit",
                "render": function (url) {
                    return '<a href="#" onclick="load(' + url + ')"><i class="fa fa-pencil"></i></a>';
                }
            },
            {
                "data": "linkDelete",
                "render": function (url) {
                    return '<a href="#" onclick="deleteLink(' + url + ')"><i class="fa fa-trash"></i></a>';
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

function deleteLink(url) {
    bootbox.confirm('Видалити посилання для викладачів?', function (result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                success: function () {
                    bootbox.confirm("Операцію успішно виконано.", function () {
                        load(basePath + "/_teacher/_admin/shareLink/index");
                    });
                },
                error:function () {
                    showDialog("Операцію не вдалося виконати.");
                }
            });
        } else {
            showDialog("Операцію відмінено.");
        }
    });
}

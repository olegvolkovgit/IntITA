function initShareLinks() {
    $jq('#shareLinksTable').DataTable({
        "ajax": {
            "url": basePath + "/_teacher/_admin/shareLink/shareLinksList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "width": "30%",
                "data": "name"
            },
            {
                "data": "link",
                "render": function (link) {
                    return '<a href="#" onclick="load(' + link["url"] + ')">' + link["title"] + '</a>';
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

function deleteLink(url, id) {
    bootbox.confirm('Видалити посилання для викладачів?', function (result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                data: {id : id},
                success: function () {
                    bootbox.alert("Операцію успішно виконано.", function () {
                        load(basePath + "/_teacher/_admin/shareLink/index");
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

function initGraduatesTable() {
    $jq('#graduatesTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/graduate/getGraduatesList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "width": "20%",
                "data": "name",
                "render": function (name) {
                    return '<a href="#" onclick="load(' + name["link"] + ', ' + '\'Випускник ' +name["header"] + '\''+')">' + name["title"] + '</a>';
                }
            },
            {
                "width": "15%",
                "data": "avatar",
                "render": function (url) {
                    return '<img src="' + url + '" class="imageClass"/>';
                }
            },
            {
                "width": "15%",
                "data": "position"
            },
            {
                "width": "15%",
                "data": "workPlace"
            },
            {
                className: "recall",
                "data": "recall"
            }],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function deletePhoto(url, id, name) {
    bootbox.confirm('Ви впевнені, що хочете видалити фото випускника ' + name + '?', function (result) {
        if (result) {
            $jq.ajax({
                type: "POST",
                url: url,
                data: {'id': id},
                cache: false,
                success: function (data) {
                    if (data == true) {
                        bootbox.alert("Фото " + name + " видалено!");
                    }
                }
            });
        }
    });
}

function deleteGraduate(url, id) {
    bootbox.confirm('Видалити випускника?', function (result) {
        if (result) {
            $jq.ajax({
                type: "POST",
                url: url,
                data: {'id': id},
                cache: false,
                success: function (response) {
                    bootbox.alert(response);
                    load( basePath + '/_teacher/_admin/graduate/index', 'Випускники');
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
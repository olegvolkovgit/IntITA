function initFreeLectures(){
    $jq('#freeLecturesTable').DataTable({
        "ajax": {
            "url": basePath + "/_teacher/_admin/freeLectures/getFreeLecturesList",
            "dataSrc": "data"
        },
        "columns": [
            { "data": "module" },
            { "data": "order" },
            { "data": "title" },
            { "data": "type" },
            { "data": "status" },
            {
                "data": "url",
                "render": function (url) {
                    return '<a href="#" onclick="setLectureStatus('  + url + ')">Змінити</a>';
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

function setLectureStatus(url){
    bootbox.confirm("Змінити статус лекції?", function(result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                success: function () {
                    bootbox.confirm("Операцію успішно виконано.", function () {
                        load(basePath + "/_teacher/_admin/freeLectures/index");
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

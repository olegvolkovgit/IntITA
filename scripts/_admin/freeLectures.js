function initFreeLectures(){
    $jq('#freeLecturesTable').DataTable({
        "ajax": {
            "url": basePath + "/_teacher/_admin/freeLectures/getFreeLecturesList",
            "dataSrc": "data"
        },
        "columns": [
            null,
            {className: "center"},
            {className: "center"},
            null,
            null,
            {className: "center"}],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
            console.log($jq(row).attr('class'));
        },
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function setLectureStatus(url, question){
    bootbox.confirm(question, function(result) {
        if (result != null) {
            $jq.ajax({
                url: url,
                type: "POST",
                success: function () {
                    bootbox.confirm("Операцію успішно виконано.", function () {
                        load(basePath + "/_teacher/_admin/freeLectures/index");
                    });
                }
            });
        } else {
            showDialog("Операцію не вдалося виконати.");
        }
    });
}

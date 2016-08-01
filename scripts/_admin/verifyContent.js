

function initWaitLectures() {
    $jq('#waitLecturesTable').DataTable({
        "ajax": {
            "url": basePath + "/_teacher/_admin/verifyContent/waitLecturesList",
            "dataSrc": "data"
        },
        "columns": [
            { "data": "module" },
            {
                "width": "10%",
                "data": "order" },
            { "data": "title" },
            {
                "width": "15%",
                "data": "type" },
            {
                "width": "15%",
                "data": "id",
                "render": function (id) {
                    return '<a href="#/lecture/confirm/'+id+'">Затвердити</a>';
                }
            }],

        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function initVerifiedLectures() {
    $jq('#verifiedLecturesTable').DataTable({
        "ajax": {
            "url": basePath + "/_teacher/_admin/verifyContent/verifiedLecturesList",
            "dataSrc": "data"
        },
        "columns": [
            { "data": "module" },
            {
                "width": "10%",
                "data": "order"
            },
            { "data": "title" },
            {
                "width": "15%",
                "data": "type"
            },
            {
                "width": "15%",
                "data": "id",
                "render": function (id) {
                    return '<a href="#/lecture/cancel/'+id+'">Скасувати</a>';
                }
            }],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function setVerifyStatus(url) {

}

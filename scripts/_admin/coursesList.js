function initCourses(){
    $jq('#coursesTable').DataTable({
        "ajax": {
            "url": basePath + "/_teacher/_admin/coursemanage/getCoursesList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "width": "8%",
                "data": "id"
            },
            {
                "width": "15%",
                "data": "alias" },
            {
                "data": "title",
                "render": function (title) {
                    return '<a href="#" onclick="load('  + title["link"] + ',' + title["header"] + ')">'  + title["name"] + '</a>';
                }
            },
            {
                "width": "10%",
                "data": "status"
            },
            {
                "width": "10%",
                "data": "cancelled"
            },
            {
                "width": "20%",
                "data": "level"
            }],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function setCourseStatus(url, message){
    bootbox.confirm(message, function(result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                success: function () {
                    bootbox.alert("Операцію успішно виконано.");
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

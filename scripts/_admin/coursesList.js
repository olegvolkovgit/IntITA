function initCourses(){
    $jq('#coursesTable').DataTable({
        "ajax": {
            "url": basePath + "/_teacher/_admin/coursemanage/getCoursesList",
            "dataSrc": "data",
        },
        "columns": [
            { "data": "id" },
            { "data": "alias" },
            { "data": "lang" },
            { "data": "title" },
            { "data": "status" },
            { "data": "level" },
            {
                "data": "linkView",
                "render": function (linkView) {
                    return '<a href="#" onclick="load('  + linkView + ')"><i class="fa fa-eye"></i></a>';
                }
            },
            {
                "data": "linkEdit",
                "render": function (linkEdit) {
                    return '<a href="#" onclick="load('  + linkEdit + ')"><i class="fa fa-pencil"></i></a>';
                }
            },
            {
                "data": "linkChangeStatus",
                "render": function (linkChangeStatus) {
                    return '<a href="#" onclick="setCourseStatus('  + linkChangeStatus + ')"><i class="fa fa-trash"></i></a>';
                }
            }],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        },
        dom: "<'row'<'col-sm-6'f><'col-sm-6'l>>"
    });
}

function setCourseStatus(url){
    bootbox.confirm("Змінити статус курса?", function(result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                success: function () {
                    bootbox.confirm("Операцію успішно виконано.", function () {
                        load(basePath + "/_teacher/_admin/coursemanage/index");
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

function initModules(){
    $jq('#modulesTable').DataTable({
        "ajax": {
            "url": basePath + "/_teacher/_admin/module/getModulesList",
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
                "width": "8%",
                "data": "lang"
            },
            {
                "data": "title",
                "render": function (title) {
                    return '<a href="#" onclick="load('  + title["link"] + ', ' + title["header"] + ')">'  + title["name"] + '</a>';
                }
            },
            {
                "width": "10%",
                "data": "status"
            },
            {
                "width": "17%",
                "data": "level"
            },
            {
                "width": "10%",
                "data": "cancelled"
            },
            {
                "width": "10%",
                "data": "id",
                "render": function (id) {
                    return '<button type="button" class="btn btn-outline btn-success btn-sm" href=" yryryryr" onclick="window.location.hash=\'/module/addTeacher/id/'+id+'\'">автора</button>';
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
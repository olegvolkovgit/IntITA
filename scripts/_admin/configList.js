function initConfigTable(){
    $jq('#configTable').DataTable({
        "ajax": {
            "url": basePath + "/_teacher/_admin/config/getConfigList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "width": "8%",
                "data": "id"
            },
            {
                "data": "param",
                "render": function (param) {
                    return '<a href="#" onclick="load('  + param["link"] + ',' + '\'Налаштування ' +param["name"] + '\''+')">'  + param["name"] + '</a>';
                }
            },
            {
                "data": "value"
            },
            {
                //"width": "8%",
                "data": "label"
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
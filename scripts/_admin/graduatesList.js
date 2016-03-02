function initGraduatesTable(){
    $jq('#graduatesTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/graduate/getGraduatesList",
            "dataSrc": "data"
        },
        "columns": [
            {"data": "name"},
            {
                "data": "avatar",
                "render": function (url) {
                    return '<img src="' + url + '"/>';
                }
            },
            {"data": "position"},
            {"data": "workPlace"},
            {"data": "recall"},
            {
                "data": "linkView",
                "render": function (linkView) {
                    return '<a href="#" onclick="load(' + linkView + ')"><i class="fa fa-eye"></i></a>';
                }
            },
            {
                "data": "linkEdit",
                "render": function (linkEdit) {
                    return '<a href="#" onclick="load(' + linkEdit + ')"><i class="fa fa-pencil"></i></a>';
                }
            },
            {
                "data": "linkDelete",
                "render": function (linkDelete) {
                    return '<a href="#" onclick="deleteGraduate(' + linkDelete + ')"><i class="fa fa-trash"></i></a>';
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
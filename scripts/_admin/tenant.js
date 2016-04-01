function initTenantsTable(){
    $jq('#tenantsTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/users/getTenantsList",
            "dataSrc": "data"
        },
        "columns": [
            {"data": "name"},
            {"data": "email"},
            {
                type: 'de_date', targets: 1 ,
                "width": "15%",
                "data": "register"
            },
            {
                type: 'de_date', targets: 1 ,
                "width": "15%",
                "data": "cancelDate"
            },
            {
                "width": "10%",
                "data": "profile",
                "render": function (url) {
                    return '<a href="' + url + '" target="_blank">Профіль</a>';
                }
            },
            {
                "width": "5%",
                "data": "mailto",
                "render": function (url) {
                    return '<a class="btnChat"  href="' + url + '"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">' +
                        '<i class="fa fa-envelope fa-fw"></i></a>';
                }
            },
            {
                "width": "5%",
                "data": "cancel",
                "render": function (params) {
                    return '<a href="#" onclick="cancelRole(' + params + ')"><i class="fa fa-trash fa-fw"></i></a>';
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
function initRequestsTable() {
    $jq('#teacherResponsesTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/request/getRequestList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "width": "30%",
                "data": "user"},
            {
                "width": "30%",
                "data": "module",
                "render": function (module) {
                    return '<a href="#" onclick="load(' + module["link"] + ')">' + module["title"]+ '</a>';
                }
            },
            {
                "width": "10%",
                "data": "dateCreated"
            },
            {"data": "userApproved"},
            {  "width": "10%",
                "data": "dateApproved"}
        ],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

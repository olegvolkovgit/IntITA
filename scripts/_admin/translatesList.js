function initTranslatesList() {
    return $jq('#translatesTable').DataTable( {
        "ajax": {
            "url": basePath + "/_teacher/_admin/translate/getTranslatesList",
            "dataSrc": "data"
        },
        "columns": [
            { "data": "id",
                "width": "10%"},
            {
                "data": "language",
                "width": "10%",
                className: "center" },
            {
                "data": "category",
                "width": "15%",
                className: "center" },
            {
                "data": "translation",
                "render": function (translation) {
                    return '<a href="#" onclick="load('  + translation["link"] + ')">'  + translation["text"] + '</a>';
                }
            },
            {
                "data": "comment",
                "width": "15%"
            }
        ],
        "createdRow": function ( row, data, index ) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": basePath+"/scripts/cabinet/Ukranian.json",
        },
        processing : true,
    } );
}

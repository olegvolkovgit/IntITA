function initTranslatesList() {
    return $jq('#translatesTable').DataTable( {
        "ajax": {
            "url": basePath + "/_teacher/_admin/translate/getTranslatesList",
            "dataSrc": "data"
        },
        "columns": [
            { "width": "10%"},
            {
                "width": "10%",
                className: "center" },
            {  "width": "15%",
                className: "center" },
            null,
            { "width": "15%"},
            {  "width": "10%",
                className: "center" }],

        "createdRow": function ( row, data, index ) {
            $jq(row).addClass('gradeX');
            console.log($jq(row).attr('class'));
        },

        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    } );
}

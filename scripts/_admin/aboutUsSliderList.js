function initAboutusSliderList(){
    $jq('#aboutusSliderTable').DataTable({
        "ajax": {
            "url": basePath + "/_teacher/_admin/aboutusSlider/getItemsList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "width": "8%",
                "data": "order"
            },
            {
                "data": "photo",
                "render": function (photo) {
                    return '<a href="#" onclick="load('  + photo["link"] + ')"><img class="carouselImage" src="'  + photo["image"] + '"></a>'+
                    '<div>'+photo["text"]+'</div>';
                }
            },
            {
                "width": "10%",
                "data": "linkUp",
                "render": function (linkUp) {
                    return '<a href="#" onclick="load('  + linkUp + ')">вверх</a>';
                }
            },
            {
                "width": "10%",
                "data": "linkDown",
                "render": function (linkDown) {
                    return '<a href="#" onclick="load('  + linkDown + ')">вниз</a>';
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
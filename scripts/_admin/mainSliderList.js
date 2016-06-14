function initMainSliderList(){
    $jq('#mainSliderTable').DataTable({
        "ajax": {
            "url": basePath + "/_teacher/_admin/carousel/getItemsList",
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
                    return '<a href="#" onclick="load('  + photo["link"] + ')"><img class="carouselImage" src="'  + photo["image"] + '"></a>' +
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
            },
            {
                "width": "10%",
                "data": "textUp",
                "render": function (textUp) {
                    return '<a href="#" onclick="load('  + textUp + ')">вверх</a>';
                }
            },
            {
                "width": "10%",
                "data": "textDown",
                "render": function (textDown) {
                    return '<a href="#" onclick="load('  + textDown + ')">вниз</a>';
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
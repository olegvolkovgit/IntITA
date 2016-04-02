function initCourses(){
    $jq('#coursesTable').DataTable({
        "ajax": {
            "url": basePath + "/_teacher/_admin/coursemanage/getCoursesList",
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
                "data": "title",
                "render": function (title) {
                    return '<a href="#" onclick="load('  + title["link"] + ',' + title["header"] + ')">'  + title["name"] + '</a>';
                }
            },
            {
                "width": "10%",
                "data": "status"
            },
            {
                "width": "10%",
                "data": "cancelled"
            },
            {
                "width": "20%",
                "data": "level"
            }],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function setCourseStatus(url, message){
    bootbox.confirm(message, function(result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                success: function () {
                    bootbox.alert("Операцію успішно виконано.");
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

function initUaCourses(){
    var uaCourses = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_admin/coursemanage/coursesUaByQuery?query=%QUERY',
            wildcard: '%QUERY',
            filter: function (courses) {
                return $jq.map(courses.results, function (course) {
                    return {
                        id: course.id,
                        title: course.title
                    };
                });
            }
        }
    });

    uaCourses.initialize();

    $jq('#typeaheadModule').typeahead(null, {
        name: 'modules',
        display: 'title',
        limit: 10,
        source: modules,
        templates: {
            empty: [
                '<div class="empty-message">',
                'модулів з такою назвою немає',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'>{{title}}&nbsp;</div>")
        }
    });

    $jq('#typeaheadModule').on('typeahead:selected', function (e, item) {
        $jq("#moduleId").val(item.id);
    });
}

function initRuCourses(){

}

function initEnCourses(){

}



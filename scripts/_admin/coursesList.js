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
                    return '<a href="#/course/detail/'+title["id"]+'">'  + title["name"]+ '</a>';
                    //return '<a href="#" onclick="load('  + title["link"] + ',' + title["header"] + ')">'  + title["name"] + '</a>';
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
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
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

function initCoursesTypeahead(lang){
    var courses = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_admin/coursemanage/coursesByQueryAndLang?query=%QUERY&lang=' + lang,
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

    courses.initialize();

    $jq('#typeaheadCourse').typeahead(null, {
        name: 'courses',
        display: 'title',
        limit: 10,
        source: courses,
        templates: {
            empty: [
                '<div class="empty-message">',
                'модулів з такою назвою немає',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'>{{title}}&nbsp;</div>")
        }
    });

    $jq('#typeaheadCourse').on('typeahead:selected', function (e, item) {
        $jq("#course").val(item.id);
    });
}

function addLinkedCourses(url, modelId, id, lang, header){
    bootbox.confirm("Додати курс?", function(result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                data:{
                    "lang": lang,
                    "course": id,
                    "linkedCourse" : $jq('#course').val(),
                    "modelId" : modelId
                },
                success: function (response) {
                    bootbox.alert(response, function(){
                        load(basePath + '/_teacher/_admin/coursemanage/view/id/' + id, header);
                    });
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

function deleteLinkedCourse(url, id, lang, header, course){
    bootbox.confirm("Видалити пов\'язаний курс?", function(result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                data:{
                    "id": id,
                    "lang": lang
                },
                success: function (response) {
                    bootbox.alert(response, function(){
                        load(basePath + '/_teacher/_admin/coursemanage/view/id/' + course, header);
                    });
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


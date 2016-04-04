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
            url: basePath + '/_teacher/_admin/coursemanage/coursesByQueryAndLang?lang=ua&query=%QUERY',
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

    $jq('#typeaheadUaCourse').typeahead(null, {
        name: 'uaCourses',
        display: 'title',
        limit: 10,
        source: uaCourses,
        templates: {
            empty: [
                '<div class="empty-message">',
                'модулів з такою назвою немає',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'>{{title}}&nbsp;</div>")
        }
    });

    $jq('#typeaheadUaCourse').on('typeahead:selected', function (e, item) {
        $jq("#uaCourse").val(item.id);
    });
}

function initRuCourses(){
    var ruCourses = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_admin/coursemanage/coursesByQueryAndLang?lang=ru&query=%QUERY',
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

    ruCourses.initialize();

    $jq('#typeaheadRuCourse').typeahead(null, {
        name: 'ruCourses',
        display: 'title',
        limit: 10,
        source: ruCourses,
        templates: {
            empty: [
                '<div class="empty-message">',
                'модулів з такою назвою немає',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'>{{title}}&nbsp;</div>")
        }
    });

    $jq('#typeaheadRuCourse').on('typeahead:selected', function (e, item) {
        $jq("#ruCourse").val(item.id);
    });
}

function initEnCourses(){
    var enCourses = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_admin/coursemanage/coursesByQueryAndLang?lang=en&query=%QUERY',
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

    enCourses.initialize();

    $jq('#typeaheadEnCourse').typeahead(null, {
        name: 'enCourses',
        display: 'title',
        limit: 10,
        source: enCourses,
        templates: {
            empty: [
                '<div class="empty-message">',
                'модулів з такою назвою немає',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'>{{title}}&nbsp;</div>")
        }
    });

    $jq('#typeaheadEnCourse').on('typeahead:selected', function (e, item) {
        $jq("#enCourse").val(item.id);
    });
}

function addLinkedCourses(url, modelId, id, header){
    bootbox.confirm("Редагувати пов\'язані курси?", function(result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                data:{
                    "ua": $jq('#uaCourse').val(),
                    "ru": $jq('#ruCourse').val(),
                    "en": $jq('#enCourse').val(),
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


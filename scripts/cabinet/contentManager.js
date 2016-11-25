function initCoursesListTable(filter_id) {
    if (filter_id == 1) {
        var temp_name = '#statusOfCoursesTableWithoutVideos';
    }
    if (filter_id == 2) {
        var temp_name = '#statusOfCoursesTableWithoutTests';
    }if (filter_id == 3) {
        var temp_name = '#statusOfCoursesTableWithoutTestsAndVideos';
    }if (filter_id == 0) {
        var temp_name = '#statusOfCoursesTable';
    }
    $jq(temp_name).DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_content_manager/contentManager/getCoursesList?filter_id="+filter_id,
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "name",
                "render": function (name) {
                    return '<a href="#/content_manager/statusOfModules/'+name["url"]+'">' + name["title"] + '</a>';
                }
            },
            {
                type: 'number', targets: 1,
                "data": "module"
            },
            {
                type: 'number', targets: 1,
                "data": "lesson"
            },
            {
                type: 'number', targets: 1,
                "data": "video"
            },
            {
                type: 'number', targets: 1,
                "data": "test"
            },
            {
                type: 'number', targets: 1,
                "data": "part"
            },
            {
                type: 'number', targets: 1,
                "data": "revision"
            }
        ],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
        },
        language: {
            "url": basePath + "/scripts/cabinet/Ukranian.json",
        },
        processing: true,
    });
}

function initLessonsListTable(idModule) {
    $jq('#statusOfLessonsTable').DataTable({

        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_content_manager/contentManager/getLessonsList?idModule=" + idModule,
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "name",
                "render": function (name) {
                    return '<a href="#/detail/lesson/'+name["url"]+'">' + name["title"] + '</a>';
                }
            },
            {
                type: 'number', targets: 1,
                "data": "parts"
            },
            {
                type: 'number', targets: 1,
                "data": "video"
            }
            ,
            {
                type: 'number', targets: 1,
                "data": "tests"
            },
            {
                type: 'number', targets: 1,
                "data": "word"
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

function initPartsListTable(idLesson) {
    $jq('#statusOfPartsTable').DataTable({

        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_content_manager/contentManager/getPartsList?idLesson=" + idLesson,
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "name",
                "render": function (name) {
                    if(name["title"]===''){
                        return '<a href="'+name["link"]+'#/page'+name["page_order"]+'" target="_blank">Переглянути</a>';
                    }else{
                        return '<a href="'+name["link"]+'#/page'+name["page_order"]+'" target="_blank">' + name["title"] + '</a>';
                    }
                }
            },
            {
                type: 'number', targets: 1,
                "data": "video"
            }
            ,
            {
                type: 'number', targets: 1,
                "data": "test"
            }
            ,
            {
                type: 'number', targets: 1,
                "data": "word"
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


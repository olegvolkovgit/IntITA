function initTeachersAdminTable() {
    $jq('#teachersAdminTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/teachers/getTeachersAdminList",
            "dataSrc": "data"
        },
        "columns": [
            {"data": "name"},
            {"data": "email"},
            {"data": "status"},
            {
                "data": "profile",
                "render": function (url) {
                    return '<a href="' + url + '" target="_blank">Cторінка</a>';
                }
            },
            {
                "data": "mailto",
                "render": function (url) {
                    return '<a class="btnChat"  href="' + url + '"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">' +
                        '<i class="fa fa-envelope fa-fw"></i></a>';
                }
            },
            {
                "data": "linkView",
                "render": function (linkView) {
                    return '<a href="#" onclick="load(' + linkView + ')"><i class="fa fa-eye"></i></a>';
                }
            },
            {
                "data": "linkEdit",
                "render": function (linkEdit) {
                    return '<a href="#" onclick="load(' + linkEdit + ')" ><i class="fa fa-pencil"></i></a>';
                }
            },
            {
                "data": "linkChangeStatus",
                "render": function (linkChangeStatus) {
                    return '<a href="#" onclick="setTeacherStatus(' + linkChangeStatus + ')">' +
                        '<i class="fa fa-refresh"></i></a>';
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

function generateEnglishName(first, last, middle) {
    if (document.getElementById("Teacher_first_name_en").value == '') {
        generateFirst(first);
    }
    if (document.getElementById("Teacher_middle_name_en").value == '') {
        generateMiddle(middle);
    }
    if (document.getElementById("Teacher_last_name_en").value == '') {
        generateLast(last);
    }
}


function generateFirst(first){
    $("#Teacher_first_name_en").val(toEnglish(first));
}

function generateMiddle(middle){
    $("#Teacher_middle_name_en").val(toEnglish(middle));
}

function generateLast(last){
    $("#Teacher_last_name_en").val(toEnglish(last));
}

function loadTeachersIndex() {
    load(basePath + '/_teacher/_admin/teachers/index', 'Викладачі');
}

function setTeacherStatus(url) {
    bootbox.confirm('Змінити статус викладача?', function (result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                success: function (response) {
                    if(response == "success") {
                        bootbox.confirm("Статус викладача змінено.", loadTeachersIndex);
                    } else {
                        showDialog("Операцію не вдалося виконати.");
                    }
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
function initTeachersAdminTable() {
    $jq('#teachersAdminTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_admin/teachers/getTeachersAdminList",
            "dataSrc": "data"
        },
        "columns": [
            {
                "data": "name",
                "render": function (name) {
                    return '<a href="#" onclick="load(' + name["link"] + ')">' + name["name"] + '</a>';
                }
            },
            {
                "width": "30%",
                "data": "email"
            },
            {
                "width": "10%",
                "data": "status"
            },
            {
                "width": "10%",
                "data": "changeStatus",
                "render": function (changeStatus) {
                    return '<a href="#" onclick="setTeacherStatus(' +  changeStatus["link"] + ')">' +
                        changeStatus["title"] + '</a>';
                }
            },
            {
                "width": "5%",
                "data": "mailto",
                "render": function (url) {
                    return '<a class="btnChat"  href="' + url + '"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">' +
                        '<i class="fa fa-envelope fa-fw"></i></a>';
                }
            },
            {
                "width": "10%",
                "data": "addModuleLink",
                "render": function (link) {
                    return '<button type="button" class="btn btn-outline btn-success btn-sm" onclick="load(' +  link + ')">модуль</button>';
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
    $jq("#Teacher_first_name_en").val(toEnglish(first));
}

function generateMiddle(middle){
    $jq("#Teacher_middle_name_en").val(toEnglish(middle));
}

function generateLast(last){
    $jq("#Teacher_last_name_en").val(toEnglish(last));
}

function translateName(source, id, sourceId) {
    if(!source) source = $jq(sourceId).val();
    $jq(id).val(toEnglish(source));
}

function loadAdminTeachersIndex() {
    load(basePath + '/_teacher/_admin/teachers/index', 'Викладачі');
}

function setTeacherStatus(url, usersPage) {
    bootbox.confirm('Змінити статус викладача?', function (result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                success: function (response) {
                    if(response == "success") {
                        bootbox.confirm("Статус викладача змінено.", function(){
                            if(usersPage == 'true'){
                                loadUsersIndex(2);
                            } else {
                                loadAdminTeachersIndex();
                            }
                        });
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
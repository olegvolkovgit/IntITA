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
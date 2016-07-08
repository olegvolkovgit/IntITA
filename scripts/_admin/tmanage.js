function addTeacherAttr(url, attr, id, role,header,redirect) {
    user = $jq('#user').val();
    if (!role) {
        role = $jq('#role').val();
    }
    var value = $jq(id).val();

    if (value == 0) {
        showDialog('Введіть дані форми.');
    }
    if (parseInt(user && value)) {
        $jq.ajax({
            url: url,
            type: "POST",
            async: true,
            data: {user: user, role: role, attribute: attr, attributeValue: value},
            success: function (response) {
                if (response == "success") {
                    bootbox.alert("Операцію успішно виконано.", function () {
                        switch (role) {
                            case "trainer":
                                loadTrainerStudentList(user);
                                break;
                            case "author":
                                if(redirect=='teacherAccess')
                                    loadAddTeacherAccess(header,'0');
                                else if (id == '#moduleId')
                                    loadAddModuleAuthor();
                                else if (id == '#module')
                                    loadModuleEdit(value,header,'5');
                                else loadTeacherModulesList(user);
                                break;
                            case "consultant":
                                if(redirect=='teacherAccess')
                                    loadAddTeacherAccess(header,'2');
                                else if(redirect=='editModule')
                                    loadModuleEdit(value,header,'6');
                                else loadAddModuleConsultant(user);
                                break;
                            case "teacher_consultant":
                                loadTeacherConsultantList(user);
                                break;
                        }
                    });
                } else {
                    switch (role) {
                        case "trainer":
                            showDialog(response);
                            break;
                        case "author":
                            showDialog("Обраний модуль вже присутній у списку модулів даного викладача");
                            break;
                        case "consultant":
                            showDialog("Консультанту вже призначений даний модуль для консультацій");
                            break;
                        case "teacher_consultant":
                            showDialog("Обраний модуль вже присутній у списку модулів даного викладача");
                            break;
                        default:
                            showDialog("Операцію не вдалося виконати");
                            break;
                    }
                }
            },
            error: function () {
                showDialog("Операцію не вдалося виконати.");
            }
        });
    }
}

function cancelModuleAttr(url, id, attr, role, user, successUrl,tab,header) {
    if (!user) {
        user = $jq('#user').val();
    }
    if (!role) {
        role = $jq('#role').val();
    }
    if (user && role) {
        $jq.ajax({
            url: url,
            type: "POST",
            async: true,
            data: {user: user, role: role, attribute: attr, attributeValue: id},
            success: function (response) {
                if (response == "success") {
                    bootbox.alert("Операцію успішно виконано.", function () {
                        if (successUrl) {
                            load(successUrl,header,'',tab);
                        } else {
                            switch (role) {
                                case "trainer":
                                    loadTrainerStudentList(user);
                                    break;
                                case "author":
                                    if (id == '#moduleId')
                                        loadAddModuleAuthor();
                                    else loadTeacherModulesList(user);
                                    break;
                                case "consultant":
                                    loadAddModuleConsultant(user);
                                    break;
                                case "teacher_consultant":
                                    loadTeacherConsultantList(user);
                                    break;
                            }
                        }
                    });
                } else {
                    showDialog("Операцію не вдалося виконати.");
                }
            },
            error: function () {
                showDialog("Операцію не вдалося виконати.");
            }
        });
    }
}

function saveSchema(url, id) {
    $jq.ajax({
        url: url,
        success: function (response) {
            if (response == "success")
                bootbox.alert("Схема курсу збережена.", function () {
                    load(basePath + '/_teacher/_admin/coursemanage/view/id/' + id);
                });
            else bootbox.alert("Схему курса не вдалося зберегти.");
        },
        error: function () {
            bootbox.alert("Схему курса не вдалося зберегти.");
        }
    });
}

function addCoursePrice(url,header) {
    var moduleId = $jq('#module').val();
    var price = $jq('#price').val();
    var courseId = $jq("#course").val();
    if (moduleId && price && courseId) {
        $jq.ajax({
            url: url,
            type: 'post',
            data: {'module': moduleId, 'course': courseId, 'price': price},
            success: function (response) {
                if (response == "success")
                    bootbox.alert("Нова ціна збережена.", function () {
                        loadModuleEdit(moduleId,header,'7');
                    });
                else bootbox.alert("Операцію не вдалося виконати.");
            },
            error: function () {
                bootbox.alert("Операцію не вдалося виконати.");
            }
        });
    }
    else {
        bootbox.alert('Неправильно введені дані.');
    }
}

function addMandatory(url) {
    var mandatory = $jq("select[name=mandatory] option:selected").val();
    var courseId = $jq("input[name=course]").val();
    var moduleId = $jq("input[name=module]").val();
    if (mandatory && courseId && moduleId) {
        $jq.ajax({
            url: url,
            type: 'post',
            data: {'module': moduleId, 'course': courseId, 'mandatory': mandatory},
            success: function (response) {
                bootbox.confirm(response, function () {
                    load(basePath + '/_teacher/_admin/module/view/id/' + moduleId);
                });
            },
            error: function () {
                showDialog('Операцію не вдалося виконати.');
            }
        });
    }
}

function addTranslate(url) {
    var form = document.forms["translate"];
    var id = form['id'].value;
    var category = form['category'].value;
    var comment = form['comment'].value;
    var translateUa = form['translateUa'].value;
    var translateRu = form['translateRu'].value;
    var translateEn = form['translateEn'].value;
    var reg = '^[a-zA-Z ]+$';

    if (category.match(reg)) {
        $jq.ajax({
            url: url,
            type: 'post',
            data: {
                'id': id,
                'category': category,
                'comment': comment,
                'translateUa': translateUa,
                'translateRu': translateRu,
                'translateEn': translateEn
            },
            success: function (data) {
                fillContainer(data);
            },
            error: function (data) {
                showDialog(data.responseText);
            }
        });
    }
    else {
        showDialog('Категорія має бути вказана латинськими літерами');
    }

}
function sendError(form, data, hasError) {
    if (hasError) {
        for (var prop in data) {
            var err = document.getElementById(prop);
            err.focus();
            break;
        }
    }
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Validations
function validateSliderForm(scenario) {
    var valid = [];
    valid.push(numberValidate($jq('#text_ua')));
    valid.push(numberValidate($jq('#text_ru')));
    valid.push(numberValidate($jq('#text_en')));
    if (scenario == 'insert')
        valid.push(filePicValidate($jq('#picture')));
    return checkValid(valid);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//input validation function
function filePicValidate(picture) {
    var message = '';
    var pattern = /^.*\.(?:jpg|png|gif)\s*$/ig;
    var error = false;

    if (!picture.val()) {
        message = 'Виберіть файл';
        error = true;
    }
    else if (!pattern.test(picture.val())) {
        message = 'Файл має бути у форматі jpg,gif або png';
        error = true;
    }

    processResult(error, message, picture);
    return !error;
}

function numberValidate(number) {
    var message = '';
    var error = false;

    if (!number.val()) {
        error = true;
        message = 'Поле для вводу коду текста має бути заповнене';
    }

    processResult(error, message, number);

    return !error;

}
//show or hide validation message
function processResult(error, message, element) {
    if (error) {
        showErrorMessage(message, element);
    }
    else {
        hideErrorMessage(element);
    }
}
function checkValid(arr) {
    var hasError = false;
    for (var i = 0; i < arr.length; i++) {
        if (arr[i] == false) {
            return hasError;
        }
    }
    return !hasError;
}
function showErrorMessage(message, element) {
    var errorBlock = element.parent().find('.errorMessage');
    errorBlock.html(message);
    errorBlock.show();
    element.focus();
}


function hideErrorMessage(element) {
    var errorBlock = element.parent().find('.errorMessage');
    errorBlock.hide();
}
//Modal windows
function showDialog(str) {
    if (str) {
        $jq('#modalText').html(str);
    }
    $jq('#myModal').modal('show');
}

function moduleCancelled(str, url) {
    bootbox.confirm(str, function (result) {
        if (result) {
            var grid = getGridName();

            $jq.ajax({
                url: url,
                type: 'post',
                async: true,
                success: function (data) {
                    if (data == false) {
                        if (grid)
                            $.fn.yiiGridView.update(grid);
                        else
                            fillContainer(data);
                    } else {
                        bootbox.alert("Ти не можеш видалити модуль. Спочатку видали його з таких курсів: " + "<b>" + data + "</b>");
                        return false;
                    }
                },
                error: function () {
                    showDialog();
                }
            });
        }
    })
}

function getGridName() {
    return $jq('.grid-view').attr('id');
}

function refreshCache(url) {
    $jq.ajax({
        url: url,
        type: 'post',
        async: true,
        success: function (data) {
            if (data == "success") {
                showDialog("Кеш сайта успішно оновлено!");
            } else {
                showDialog();
            }
        },
        error: function () {
            showDialog();
        }
    });
}
function deleteSlideAboutUs(url) {
    bootbox.confirm('Видалити слайд?', function (result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                async: true,
                success: function (response) {
                    bootbox.alert("Слайд видалено.", function () {
                        loadSliderAboutUsList();
                    });
                },
                error: function () {
                    showDialog("Операцію не вдалося виконати.");
                }
            });
        }
    });
}
function saveSliderTextPosition(url,id) {
    bootbox.confirm('Зберегти позицію тексту?', function (result) {
        if (result) {
            var text = document.getElementById('textPosition');
            var sliderBox=document.getElementById('sliderContainer');
            var left=(text.offsetLeft+text.offsetWidth/2)/sliderBox.offsetWidth*100;
            var top=text.offsetTop/sliderBox.offsetHeight*100;
            if(sliderColorPreview())
            var color=sliderColorPreview();
            else return;

            $jq.ajax({
                url: url,
                type: "POST",
                data: {
                    'id': id,
                    'left': left,
                    'top': top,
                    'color': color
                },
                async: true,
                success: function (response) {
                    bootbox.alert("Позицію тексту збережено", function () {
                    });
                },
                error: function () {
                    showDialog("Операцію не вдалося виконати.");
                }
            });
        }
    });
}
function sliderColorPreview(){
    var text = document.getElementById('textPosition');
    var color=document.getElementById('textColor').value;
    var regHEX = /^#(?:[0-9a-f]{3}){1,2}$/i;
    if (!regHEX.test(color)) {
        bootbox.alert('Заданий колір не відповідає HEX формату');
        return false;
    }else{
        text.style.color=color;
        return color;
    }
}
function deleteMainSlide(url) {
    bootbox.confirm('Видалити слайд?', function (result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                async: true,
                success: function (response) {
                    bootbox.alert("Слайд видалено.", function () {
                        loadMainSliderList();
                    });
                },
                error: function () {
                    showDialog("Операцію не вдалося виконати.");
                }
            });
        }
    });
}
function moduleValidation(data,hasError) {
    if(hasError) {
        if(data['Module_title_ua'] !== undefined)
            $jq('.moduleTabs li:eq(1) a').tab('show');
        else $jq('.moduleTabs li:eq(0) a').tab('show');
        return false;
    }else return true;
}
function moduleCreate(url) {
    var formData = new FormData($("#module-form")[0]);
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        datatype:'json',
        success: function () {
            bootbox.alert("Модуль успішно додано", function () {
                loadModulesList();
            });
        },
        error: function () {
            bootbox.alert("Модуль не вдалося створити. Перевірте вхідні дані або зверніться до адміністратора.");
        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
}
function moduleUpdate(url) {
    var formData = new FormData($("#module-form")[0]);
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        datatype:'json',
        success: function () {
            bootbox.alert("Модуль успішно відредаговано", function () {
                loadModulesList();
            });
        },
        error: function () {
            bootbox.alert("Модуль не вдалося відредагувати. Перевірте вхідні дані або зверніться до адміністратора.");
        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
}
function courseValidation(data,hasError) {
    if(hasError) {
        if(data['Course_title_ua'] !== undefined)
            $jq('.courseTabs li:eq(1) a').tab('show');
        else if(data['Course_title_ru'] !== undefined)
            $jq('.courseTabs li:eq(2) a').tab('show');
        else if(data['Course_title_en'] !== undefined)
            $jq('.courseTabs li:eq(3) a').tab('show');
        else $jq('.courseTabs li:eq(0) a').tab('show');
        return false;
    }else return true;
}
function courseCreate(url) {
    var formData = new FormData($("#course-form")[0]);
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        datatype:'json',
        success: function () {
            bootbox.alert("Курс успішно додано", function () {
                loadCourseList();
            });
        },
        error: function () {
            bootbox.alert("Курс не вдалося створити. Перевірте вхідні дані або зверніться до адміністратора.");
        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
}
function courseUpdate(url) {
    var formData = new FormData($("#course-form")[0]);
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        datatype:'json',
        success: function () {
            bootbox.alert("Курс успішно відредаговано", function () {
                loadCourseList();
            });
        },
        error: function () {
            bootbox.alert("Курс не вдалося відредагувати. Перевірте вхідні дані або зверніться до адміністратора.");
        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
}

function loadMainSliderList() {
    load(basePath + '/_teacher/_admin/carousel/index/', 'Слайдер на головній сторінці');
}
function loadSliderAboutUsList() {
    load(basePath + '/_teacher/_admin/aboutusSlider/index/', 'Слайдер на сторінці Про нас');
}
function loadTeacherModulesList(id) {
    load(basePath + '/_teacher/_admin/teachers/editRole/id/' + id + '/role/author/', 'Редагувати роль');
}
function loadTrainerStudentList(id) {
    load(basePath + '/_teacher/_admin/teachers/editRole/id/' + id + '/role/trainer/', 'Редагувати роль');
}
function loadAddModuleAuthor() {
    load(basePath + '/_teacher/_admin/permissions/showAddTeacherAccess/');
}
function loadAddModuleConsultant(id) {
    load(basePath + '/_teacher/_admin/teachers/editRole/id/'+id+'/role/consultant/','Редагувати роль');
}
function loadModulesList() {
    load(basePath + "/_teacher/_admin/module/index/","Модулі");
}
function loadCourseList() {
    load(basePath + "/_teacher/_admin/coursemanage/index/","Курси");
}
function loadModuleEdit(id,header,tab) {
    load(basePath + "/_teacher/_admin/module/update/id/"+id,header,'',tab);
}
function loadAddTeacherAccess(header,tab) {
    load(basePath + "/_teacher/_admin/permissions/index/",header,'',tab);
}
function loadTeacherConsultantList(id) {
    load(basePath + '/_teacher/_admin/teachers/editRole/id/' + id + '/role/teacher_consultant/', 'Редагувати роль');
}

function initAllPhrasesTable() {
    $jq('#allPhrasesTable').DataTable({
        "autoWidth": false,
        "ajax": {
            "url": basePath + "/_teacher/_tenant/tenant/getAllPhrases",
            "dataSrc": "data"
        },
        "columns": [
            {
                type: 'string', targets: 1,
                "data": "text"
            },
            {

                "data": "id",
                "render": function (id) {
                    return '<a href="#" onclick="load(\'' + basePath + '/_teacher/_tenant/tenant/editPhrase?id=' + id + '\', \'Змінити фразу\');">Змінити</a>';
                }
            }, {

                "data": "id",
                "render": function (id) {
                    return '<a href="#" onclick="load(\'' + basePath + '/_teacher/_tenant/tenant/deletePhrase?id=' + id + '\', \'Видалити фразу\');">Видалити</a>';
                }
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


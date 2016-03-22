/**
 * Created by Quicks on 23.12.2015.
 */
function ShowTeacher(url, id) {
    $jq.ajax({
        url: url,
        type: 'post',
        data: {'id': id},
        success: function (data) {
            fillContainer(data);
        },
        error: function () {
            showDialog();
        }
    });
}

function addTeacherAttr(url, attr, id) {
    var user = $jq('#user').val();
    var role = $jq('#role').val();
    var value = $jq(id).val();

    if (value == 0) {
        showDialog('Введіть дані форми.');
    }
    if (user && value) {
        $jq.ajax({
            url: url,
            type: "POST",
            async: true,
            data: {user: user, role: role, attribute: attr, attributeValue: value},
            success: function (response) {
                if (response == "success") {
                    bootbox.alert("Операцію успішно виконано.", function() {
                        switch (role) {
                            case "trainer":
                                loadTrainerStudentList(user);
                                break;
                            case "author":
                                if(id=='#moduleId')
                                loadAddModuleAuthor();
                                else loadTeacherModulesList(user);
                                break;
                            case "consultant":
                                loadAddModuleConsultant(user);
                                break;
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

function cancelModuleAttr(url, id, attr) {
    var user = $jq('#user').val();
    var role = $jq('#role').val();
    if (user && role) {
        $jq.ajax({
            url: url,
            type: "POST",
            async: true,
            data: {user: user, role: role, attribute: attr, attributeValue: id},
            success: function (response) {
                if (response == "success") {
                    bootbox.alert("Операцію успішно виконано.", function () {
                        switch (role) {
                            case "trainer":
                                loadTrainerStudentList(user);
                                break;
                            case "author":
                                if(id=='#moduleId')
                                    loadAddModuleAuthor();
                                else loadTeacherModulesList(user);
                                break;
                            case "consultant":
                                loadAddModuleConsultant(user);
                                break;
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

function selectRole(url) {
    clearAllAttrFields();

    var role = $jq('select[name="role"]').val();
    var user = $jq('#teacher').val();
    if (!role) {
        $jq('div[name="selectRole"]').html('');
        $jq('div[name="selectAttribute"]').html('');
    } else {
        $jq.ajax({
            type: "POST",
            url: url,
            data: {role: role, user: user},
            cache: false,
            success: function (response) {
                $jq('div[name="selectAttribute"]').html(response);
            }
        });
    }
}

function selectAttribute(url) {
    var attribute = $jq('select[name="attribute"]').val();
    if (!attribute) {
        $jq('div[name="inputValue"]').html('');
    } else {
        $jq.ajax({
            type: "POST",
            url: url,
            data: {attribute: attribute},
            cache: false,
            success: function (response) {
                $jq('div[name="inputValue"]').html(response);
            }
        });
    }
}

function clearAllAttrFields() {
    $jq('div[name="selectAttribute"]').html('');
    $jq('div[name="inputValue"]').html('');

}


function addExistModule(url) {
    var moduleId = $jq("select[name=module] option:selected").val();
    var courseId = $jq("select[name=course] option:selected").val();
    if (moduleId && courseId) {
        $jq.ajax({
            url: url,
            type: 'post',
            data: {'moduleId': moduleId, 'courseId': courseId},
            success: function (data) {
                showDialog('Ви додали модуль до курсу');
                fillContainer(data);
            },
            error: function () {
                showDialog();
            }
        });
    }
    else
        showDialog('Виберіть вірні дані!');
    return false;
}

function saveSchema(url, id) {
    $jq.ajax({
        url: url,
        success: function (response) {
            if(response == "success")
            bootbox.alert("Схема курсу збережена.", function(){
                load(basePath + '/_teacher/_admin/coursemanage/view/id/' + id);
            });
            else bootbox.alert("Схему курса не вдалося зберегти.");
        },
        error: function () {
            bootbox.alert("Схему курса не вдалося зберегти.");
        }
    });
}

function addCoursePrice(url) {
    var moduleId = $jq('#module').val();
    var price = $jq('#price').val();
    var courseId = $jq("#course").val();
    if (moduleId && price && courseId) {
        $jq.ajax({
            url: url,
            type: 'post',
            data: {'module': moduleId, 'course': courseId, 'price': price},
            success: function (response) {
                if(response == "success")
                    bootbox.alert("Нова ціна збережена.", function(){
                        load(basePath + '/_teacher/_admin/module/view/id/' + moduleId);
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
                bootbox.confirm(response, function(){
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
    var reg = '^[a-zA-Z]+$';

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
function validateSliderForm() {
    var valid = [];
    valid.push(numberValidate($jq('#text')));
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
    var pattern = /^\d+$/;
    var error = false;

    if (!number.val()) {
        error = true;
        message = 'Поле для вводу коду текста має бути заповнене';
    }
    else if ((!pattern.test(number.val()))) {
        error = true;
        message = 'Можна ввести тільки цифри';
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

function showConfirm(str, url) {
    bootbox.confirm(str, function (result) {
        if (result) {
            var grid = getGridName();

            $jq.ajax({
                url: url,
                type: 'post',
                async: true,
                success: function (data) {
                    if (grid)
                        $.fn.yiiGridView.update(grid);
                    else
                        fillContainer(data);
                },
                error: function () {
                    showDialog();
                }
            });
        }
    })
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

function loadTeacherModulesList(id) {
    load(basePath + '/_teacher/_admin/teachers/addModule/id/'+id,'Додати модуль');
}
function loadTrainerStudentList(id) {
    load(basePath + '/_teacher/_admin/teachers/editRole/id/'+id+'/role/trainer/','Редагувати роль');
}
function loadAddModuleAuthor() {
    load(basePath + '/_teacher/_admin/permissions/showAddTeacherAccess/');
}
function loadAddModuleConsultant(id) {
    load(basePath + '/_teacher/_admin/teachers/editRole/id/'+id+'/role/consultant/','Редагувати роль');
}


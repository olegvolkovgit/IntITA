function sendError(form, data, hasError) {
    if (hasError) {
        for (var prop in data) {
            var err = document.getElementById(prop);
            err.focus();
            break;
        }
    }
}

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

function moduleValidation(data,hasError) {
    if(hasError) {
        $jq("#"+Object.keys(data)[0]).focus();
        return false;
    }else return true;
}
function moduleCreate(url) {
    var formData = new FormData($("#module-form")[0]);
    if(typeof moduleTags!='undefined'){
        formData.append('moduleTags', JSON.stringify(moduleTags));
        delete moduleTags;
    }
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        datatype:'json',
        success: function () {
            bootbox.alert("Модуль успішно додано", function () {
               location.hash = "/organization/modules";
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
function moduleUpdate(url,moduleId) {
    var formData = new FormData($("#module-form")[0]);
    if(typeof moduleTags!='undefined'){
        formData.append('moduleTags', JSON.stringify(moduleTags));
        delete moduleTags;
    }

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        datatype:'json',
        success: function () {
            bootbox.alert("Модуль успішно відредаговано", function () {
                location.hash = "/module/id/"+moduleId;
                location.reload();
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
        if(data['Course_title_ua'] !== undefined){
            $jq('#uaTab a').click();
            $jq("#Course_title_ua").focus();
        } else if(data['Course_title_ru'] !== undefined){
            $jq('#ruTab a').click();
            $jq("#Course_title_ru").focus();
        } else if(data['Course_title_en'] !== undefined){
            $jq('#enTab a').click();
            $jq("#Course_title_en").focus();
        } else {
            $jq('#mainTab a').click();
            $jq("#"+Object.keys(data)[0]).focus();
        }
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
                location.hash = "/organization/courses";
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
function courseActions(url) {
    var formData = new FormData($("#course-form")[0]);
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        datatype:'json',
        success: function (message) {
            bootbox.alert(message, function () {
                location.hash = "/organization/courses";
                location.reload();
            });
        },
        error: function (message) {
            bootbox.alert(message);
        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
}
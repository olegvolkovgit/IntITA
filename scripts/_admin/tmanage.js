/**
 * Created by Quicks on 23.12.2015.
 */
function ShowTeacher(url,id)
{
    $.ajax({
        url: url,
        type : 'post',
        data : { 'id': id},
        success: function (data) {
            fillContainer(data);
        },
        error: function () {
            showDialog();
        }
    });
}

function addExistModule(url)
{
    var moduleId = $("select[name=module] option:selected").val();
    var courseId = $("select[name=course] option:selected").val();
    if(moduleId && courseId ){
    $.ajax({
        url: url,
        type : 'post',
        data : { 'moduleId' : moduleId , 'courseId' : courseId},
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

function saveSchema(url)
{
    $.ajax({
        url: url,
        success: function (data) {
            showDialog("Схема курсу збережена!");
            fillContainer(data);
            //location.reload();
        },
        error: function () {
            showDialog();
        }
    });
}

function addCoursePrice(url)
{
    var moduleId = document.getElementById('module').value;
    var price = document.getElementById('price').value;
    var courseId = $("select[name=course] option:selected").val();
    if(moduleId && price && courseId){
    $.ajax({
        url: url,
        type : 'post',
        data : { 'module' : moduleId , 'course' : courseId,'price': price},
        success: function (data) {
            fillContainer(data);
        },
        error: function () {
            showDialog();
        }
    });
    }
    else
    {
        showDialog();
    }
}

function addMandatory(url)
{
    var mandatory = $("select[name=mandatory] option:selected").val();
    var courseId = $("select[name=course] option:selected").val();
    var moduleId = $("#module").val();
    if(mandatory && courseId && moduleId)
    {
        $.ajax({
            url: url,
            type: 'post',
            data: {'module': moduleId, 'course': courseId, 'mandatory': mandatory},
            success: function (data) {
                fillContainer(data);
            },
            error: function () {
               showDialog();
            }
        });
    }
}

function addTranslate(url)
{
    var form = document.forms["translate"];
    var id = form['id'].value;
    var category = form['category'].value;
    var comment = form['comment'].value;
    var translateUa = form['translateUa'].value;
    var translateRu = form['translateRu'].value;
    var translateEn = form['translateEn'].value;
    var reg = '^[a-zA-Z]+$';

    if(category.match(reg))
    {
        $.ajax({
            url: url,
            type: 'post',
            data: {'id': id,
                'category': category,
                'comment': comment,
                'translateUa' : translateUa,
                'translateRu' : translateRu,
                'translateEn' : translateEn},
            success: function (data) {
                fillContainer(data);
            },
            error: function (data) {
                    showDialog(data.responseText);
            }
        });
    }
    else
    {
        showDialog('Категорія має бути вказана латинськими літерами');
    }

}
function send(form,data,hasError)
{
    if(hasError){
        for(var prop in data)
        {
            var err = document.getElementById(prop);
            err.focus();
            break;
        }
    }
    else {
        $.ajax({
            type: "POST",
            url: form[0].action,
            data: $(form).serialize(),
            success: function(data) {
                fillContainer(data);
            }
        });
    }
}

function validateSliderForm()
{
    var picFile = $('#picture');
    var code = $('#text');
    var numbVal = numberValidate(code);
    var pictVal = filePicValidate(picFile);

    if(numbVal && pictVal)
    {
        return true;
    }
    else return false;

}

function filePicValidate(picture)
{
    var message = '';
    var pattern = /^.*\.(?:jpg|png|gif)\s*$/ig;
    var error = false;

    if(!pattern.test(picture.val()))
    {
        message = 'Файл має бути у форматі jpg,gif або png';
        error = true
    }
    if(!picture.val())
    {
        message = 'Виберіть файл';
        error = true;
    }

    if(error)
    {
        showErrorMessage(message,picture);
    }
    else
    {
        hideErrorMessage(picture);
    }
    return !error;

}

function numberValidate(number)
{
    var message = '';
    var pattern = /^\d+$/;
    var error = false;

    if(!pattern.test(number.val()))
    {
        error = true;
        message = 'Можна ввести тільки цифри';
    }

    if(!number.val()){
        error = true;
        message = 'Поле для вводу коду текста має бути заповнене';
    }

    if(error)
    {
        showErrorMessage(message,number);
    }
    else
    {
        hideErrorMessage(number);
    }
    return !error;

}

function showErrorMessage(message,element)
{
    var errorBlock = element.parent().find('.errorMessage');
    errorBlock.html(message);
    errorBlock.show();
    element.focus();
}


function hideErrorMessage(element)
{
    var errorBlock = element.parent().find('.errorMessage');
    errorBlock.hide();
}

function validateTeacherForm()
{
    alert('dsadsad');
    return true;
}

function showDialog(str)
{
    if(str){
    $('#modalText').html(str);
    }
    $('#myModal').modal('show');
}



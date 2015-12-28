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
            alert("Вибачте, але на сайті виникла помилка. " +
            "Спробуйте зайти до кабінету пізніше або зв'яжіться з адміністратором сайту.");
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
            fillContainer(data);
        },
        error: function () {
            alert("Вибачте, але на сайті виникла помилка. " +
            "Спробуйте зайти до кабінету пізніше або зв'яжіться з адміністратором сайту.");
        }
    });
    }
    else
        alert('Виберіть вірні дані!');
        return false;
}

function saveSchema(url)
{
    $.ajax({
        url: url,
        success: function (data) {
            alert("Схема курсу збережена!")
            location.reload();
        },
        error: function () {
            alert("Вибачте, але на сайті виникла помилка. " +
            "Спробуйте зайти до кабінету пізніше або зв'яжіться з адміністратором сайту.");
        }
    });
}

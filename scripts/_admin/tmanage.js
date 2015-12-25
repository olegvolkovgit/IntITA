/**
 * Created by Quicks on 23.12.2015.
 */
function ShowTeacher(id)
{
    var url = "/IntITA/_teacher/teachers/showTeacher";

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
function sendForm()
{
    return false;
}

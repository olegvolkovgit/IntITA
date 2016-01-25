/**
 * Created by Quicks on 20.01.2016.
 */
function selectMandatoryModule(url)
{
    var course = $('select[name="course"]').val();
    $.ajax({
        type: "POST",
        url:  url,
        data: {course: course},
        cache: false,
        success: function(response){  $('div[name="selectModule"]').html(response); }
    });
}

function checkMandatory()
{
    var course = $('select[name="course"]').val();
    var module = $('select[name="mandatory"]').val();

    if(course&&module)
        return true;
    else
    {
        $('.errorMessage').html('Поле не може бути пустим');
        return false;
    }
}
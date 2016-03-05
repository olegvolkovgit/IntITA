/**
 * Created by Quicks on 20.01.2016.
 */
function selectMandatoryModule(url)
{
    var course = $jq('select[name="course"]').val();
    $jq.ajax({
        type: "POST",
        url:  url,
        data: {course: course},
        cache: false,
        success: function(response){  $('div[name="selectModule"]').html(response); }
    });
}

function checkMandatory()
{
    var course = $jq('select[name="course"]').val();
    var module = $jq('select[name="mandatory"]').val();

    if(course&&module)
        return true;
    else
    {
        $jq('.errorMessage').html('Поле не може бути пустим');
        return false;
    }
}
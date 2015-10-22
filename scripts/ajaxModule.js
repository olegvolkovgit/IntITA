/**
 * Created by Quicks on 21.10.2015.
 */
function selectModule(){
    var course = $('select[name="course"]').val();
    $.ajax({
        type: "POST",
        url:  "../getModuleByCourse",
        data: {course: course},
        cache: false,
        success: function(response){  $('div[name="selectModule"]').html(response); }
    });
}

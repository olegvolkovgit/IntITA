/**
 * Created by Quicks on 21.10.2015.
 */
function selectModule(url){
    var course = $('select[name="course"]').val();
    $.ajax({
        type: "POST",
        url:  url,
        data: {course: course},
        cache: false,
        success: function(response){  $('div[name="selectModule"]').html(response); }
    });
}

function confirmDelete(id){

    var moduleId = getSecondPart(id.toString());

    $.ajax({
        url: '../courseModuleList',
        type:"POST",
        data: {id: moduleId},
        success: function(JSON){
            alert(JSON);
        }

    });
}


function getSecondPart(str) {
    var res = str.split("=");
    return res[1];
}
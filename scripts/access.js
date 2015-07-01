/**
 * Created by Ivanna on 25.05.2015.
 */
function addAccess(){
    document.getElementById('addAccess').style.display = 'block';
}

function addTeacherAccess(){
    document.getElementById('addTeacherAccess').style.display = 'block';
}


function selectModule(){
    var course = $('select[name="course"]').val();
    if(!course){
        $('div[name="selectModule"]').html('');
        $('div[name="selectLecture"]').html('');
    }else{
        $.ajax({
            type: "POST",
            url: "/IntITA/permissions/showModules",
            //url: "http://localhost/Int/permissions/showModules",
            data: {course: course},
            cache: false,
            success: function(response){ $('div[name="selectModule"]').html(response); }
        });
    }
}

function selectModule1(){
    var course = $('select[name="course1"]').val();
    if(!course){
        $('div[name="selectModule1"]').html('');
    }else{
        $.ajax({
            type: "POST",
            //url: "http://localhost/Int/permissions/showModules",
            url: "/permissions/showModules",
            data: {course: course},
            cache: false,
            success: function(response){ $('div[name="selectModule1"]').html(response); }
        });
    }
}

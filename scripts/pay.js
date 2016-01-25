/**
 * Created by Quicks on 26.11.2015.
 */

function selectModule(url){
    var course = $('select[name="course"]').val();
    if(!course){
        $('div[name="selectModule"]').html('');
        $('div[name="selectLecture"]').html('');
    }else{
        $.ajax({
            type: "POST",
            url: url,
            data: {course: course},
            cache: false,
            success: function(response){ $('div[name="selectModule"]').html(response); }
        });
    }
}

function findUserByEmail(url) {
    var find = $('#find');
    var email = find.val();
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(find.val())) {
        showDialog('Please provide a valid email address');
        return false;
    }
    else
    {
        $.ajax({
            type: "POST",
            url: url,
            data : {email : email},
            success: function(JSON){
                if(JSON === 'not found') alert('Kористувача с таким email не знайдено');
                else{
                    var select = document.getElementsByName('user');
                    for(var i = 0; i < select.length; i++)
                    {
                        var nodeList = select[i];

                        for(var k = 0; k < nodeList.length; k++)
                        {
                            if (nodeList.options[k].value == JSON)
                            {
                                select[i].selectedIndex = k;
                            }
                        }
                    }
                }
            }
        });
    }
}

function checkCourseField(url)
{
    var courseId = document.getElementById("courseList").value;
    var userId = document.getElementById('user').value;
    if(!courseId){
        showDialog("Виберіть будь-ласка курс");
        return false;
    }
    if(!userId)
    {
        showDialog("Виберіть будь-ласка користувача");
        return false;
    }
    $.ajax({
        type: "POST",
        url: url,
        data: {course: courseId,
            'user' : userId},
        cache: false,
        success: function(data){
            showDialog(data);
        },
        error: function () {
            showDialog();
        }
    });

}

function checkModuleField(url)
{
    var courseId = document.getElementById('moduleCourseList').value;
    var moduleId = document.getElementById('payModuleList').value;
    var userId = document.getElementById('user').value;

    if(!courseId)
    {
        showDialog("Виберіть будь-ласка курс");
        return false;
    }
    if(!userId)
    {
        showDialog("Виберіть будь-ласка користувача");
        return false;
    }
    if(!moduleId)
    {
        showDialog("Виберіть будь-ласка модуль");
        return false;
    }
    $.ajax({
        type: "POST",
        url: url,
        data: {course: courseId,
                'module': moduleId,
                'user' : userId},
        cache: false,
        success: function(data){
            showDialog(data);
        },
        error: function () {
            showDialog();
        }


    });
    return true;
}
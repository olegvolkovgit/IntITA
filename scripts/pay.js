/**
 * Created by Quicks on 26.11.2015.
 */

function selectModule(){
    var course = $('select[name="course"]').val();
    if(!course){
        $('div[name="selectModule"]').html('');
        $('div[name="selectLecture"]').html('');
    }else{
        $.ajax({
            type: "POST",
            url:  "../../permissions/showModules",
            data: {course: course},
            cache: false,
            success: function(response){ $('div[name="selectModule"]').html(response); }
        });
    }
}

function findUserByEmail() {
    var find = $('#find');
    var email = find.val();
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(find.val())) {
        alert('Please provide a valid email address');
        return false;
    }
    else
    {
        $.ajax({
            type: "POST",
            url: "../../permissions/showUsers",
            data : {email : email},
            success: function(JSON){

                if(JSON === false) alert('Kористувач с таким email не знайдено');
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

function checkCourseField()
{
    var courseList = document.getElementById("courseList");
    if(courseList.value == ''){
        alert("Виберіть будь-ласка курс");
        return false;
    }

    else return true;

}

function checkModuleField()
{
    var moduleCourseList = document.getElementById('moduleCourseList');
    var moduleList = document.getElementById('payModuleList');
    if(moduleCourseList.value == '')
    {
        alert("Виберіть будь-ласка курс");
        return false;
    }
    if(moduleList.value == '')
    {
        alert("Виберіть будь-ласка модуль");
        return false;
    }
    return true
}
/**
 * Created by Quicks on 26.11.2015.
 */
function selectModule(url){
    var course = $jq('select[name="course"]').val();
    if(!course){
        $jq('div[name="selectModule"]').html('');
        $jq('div[name="selectLecture"]').html('');
    }else{
        $jq.ajax({
            type: "POST",
            url: url,
            data: {course: course},
            cache: false,
            success: function(response){ $jq('div[name="selectModule"]').html(response); }
        });
    }
}

function cancelCourse(url, course, user)
{
    $jq.ajax({
        type: "POST",
        url: url,
        data: {course: course,
            'user' : user},
        cache: false,
        success: function(data){
            showDialog(data);
            loadUserInfo(user);
        },
        error: function () {
            showDialog();
        }
    });
}

function loadUserInfo(user){
    load(basePath + "/_teacher/user/index/id/" + user);
}

function cancelModule(url, module, user)
{
    $jq.ajax({
        type: "POST",
        url: url,
        data: {
            'module': module,
            'user' : user},
        cache: false,
        success: function(data){
            showDialog(data);
            loadUserInfo(user);
        },
        error: function () {
            showDialog();
        }
    });
    return true;
}
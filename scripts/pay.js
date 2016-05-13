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
function selectAccessModules(url){
    var course = $jq('select[name="course"]').val();
    if(!course){
        $jq('div[name="selectModule"]').html('');
        $jq('div[name="selectLecture"]').html('');
    }else{
        $jq.ajax({
            type: "POST",
            url: basePath+url,
            data: {course: course},
            cache: false,
            success: function(response){ $jq('div[name="selectModule"]').html(response); }
        });
    }
}
function findUserByEmail(url) {
    var find = $jq('#find');
    var email = find.val();
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(find.val())) {
        showDialog('Please provide a valid email address');
        return false;
    }
    else
    {
        $jq.ajax({
            type: "POST",
            url: url,
            data : {email : email},
            success: function(JSON){
                if(JSON === 'not found') showDialog('Kористувача с таким email не знайдено');
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

function checkCourseField(url, courseId, userId)
{
    if(!courseId) {
        courseId = document.getElementById("courseId").value;
    }
    if(!userId) {
        userId = document.getElementById('user').value;
    }
    if(courseId == 0){
        showDialog("Виберіть курс.");
        return false;
    }
    if(userId == 0)
    {
        showDialog("Виберіть користувача.");
        return false;
    }
    $jq.ajax({
        type: "POST",
        url: url,
        data: {course: courseId,
            'user' : userId},
        cache: false,
        success: function(data){
            showDialog(data);
            document.getElementById('courseId').value='';
            document.getElementById('typeaheadCourse').value='';
        },
        error: function () {
            showDialog();
        }
    });

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
function checkModuleField(url, moduleId, userId)
{
    if(moduleId){
        moduleId = document.getElementById('moduleId').value;
    }
    if(userId){
        userId = document.getElementById('user').value;
    }

    if(userId == 0)
    {
        showDialog("Виберіть користувача.");
        return false;
    }
    if(moduleId == 0)
    {
        showDialog("Виберіть модуль.");
        return false;
    }
    $jq.ajax({
        type: "POST",
        url: url,
        data: {
                'module': moduleId,
                'user' : userId},
        cache: false,
        success: function(data){
            showDialog(data);
            document.getElementById('moduleId').value='';
            document.getElementById('typeaheadModule').value='';
        },
        error: function () {
            showDialog();
        }
    });
    return true;
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
function initPayTypeaheads(){
    var users = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/cabinet/usersByQuery?query=%QUERY',
            wildcard: '%QUERY',
            filter: function (users) {
                return $jq.map(users.results, function (user) {
                    return {
                        id: user.id,
                        name: user.name,
                        email: user.email,
                        url: user.url
                    };
                });
            }
        }
    });

    var modules = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_admin/teachers/modulesByQuery?query=%QUERY',
            wildcard: '%QUERY',
            filter: function (modules) {
                return $jq.map(modules.results, function (module) {
                    return {
                        id: module.id,
                        title: module.title
                    };
                });
            }
        }
    });

    var courses = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_admin/pay/coursesByQuery?query=%QUERY',
            wildcard: '%QUERY',
            filter: function (courses) {
                return $jq.map(courses.results, function (course) {
                    return {
                        id: course.id,
                        title: course.title
                    };
                });
            }
        }
    });

    users.initialize();
    modules.initialize();
    courses.initialize();

    $jq('#typeahead').typeahead(null, {
        name: 'users',
        display: 'email',
        limit: 10,
        source: users,
        templates: {
            empty: [
                '<div class="empty-message">',
                'немає користувачів з таким іменем або email\`ом',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'><img class='typeahead_photo' src='{{url}}'/> <div class='typeahead_labels'><div class='typeahead_primary'>{{name}}&nbsp;</div><div class='typeahead_secondary'>{{email}}</div></div></div>")
        }
    });

    $jq('#typeaheadModule').typeahead(null, {
        name: 'modules',
        display: 'title',
        limit: 10,
        source: modules,
        templates: {
            empty: [
                '<div class="empty-message">',
                'модулів з такою назвою немає',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'>{{title}}&nbsp;</div>")
        }
    });

    $jq('#typeaheadCourse').typeahead(null, {
        name: 'courses',
        display: 'title',
        limit: 10,
        source: courses,
        templates: {
            empty: [
                '<div class="empty-message">',
                'курсів з такою назвою немає',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'>{{title}}&nbsp;</div>")
        }
    });

    $jq('#typeaheadModule').on('typeahead:selected', function (e, item) {
        $jq("#moduleId").val(item.id);
    });

    $jq('#typeahead').on('typeahead:selected', function (e, item) {
        $jq("#user").val(item.id);
    });

    $jq('#typeaheadCourse').on('typeahead:selected', function (e, item) {
        $jq("#courseId").val(item.id);
    });
}
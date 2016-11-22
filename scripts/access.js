/**
 * Created by Ivanna on 25.05.2015.
 */
    function addAccess() {
        document.getElementById('addAccess').style.display = 'block';
    }

    function addTeacherAccess(url) {

        var moduleId = $("select[name=module] option:selected").val();
        var userId = $("select[name=user] option:selected").val();

        if(moduleId && userId)
        {
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    'module': moduleId,
                    'user' : userId
                },
                cache: false,
                success: function (data) {
                    fillContainer(data);
                },
                error:function(data)
                {
                    showDialog();
                }
            });
        }
        else
            showDialog('Спочатку виберіть дані');

    }

    function selectTeacherModules(url, teacher) {
        if (teacher == 0) {
            bootbox.alert("Виберіть викладача.");
        } else {
            $jq.ajax({
                type: "POST",
                url: url,
                data: {teacher: teacher},
                cache: false,
                success: function (response) {
                    $jq('div[name="teacherModules"]').html(response);
                }
            });
        }
    }

    function selectModule(url) {
        var course = $('select[name="course"]').val();
        if (!course) {
            $('div[name="selectModule"]').html('');
            $('div[name="selectLecture"]').html('');
        } else {
            $.ajax({
                type: "POST",
                url: url,
                data: {course: course},
                cache: false,
                success: function (response) {
                    $('div[name="selectModule"]').html(response);
                }
            });
        }
    }

    function newPermissions(url)
    {
        var rights = [];
        $("input[name='permission[]']:checked").each(function()
        {
            rights.push($(this).val());
        });
        var moduleId = $("select[name=module] option:selected").val();
        var userId = $("select[name=user] option:selected").val();

        if(rights.length==0)
        {
            showDialog('Виберіть права для користувача');
            return false;
        }

        if(moduleId && userId && rights)
        {
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    'module': moduleId,
                    'user' : userId,
                    'rights' : rights
                },
                cache: false,
                success: function (data) {
                        fillContainer(data);
                },
                error:function(data)
                {
                  showDialog();
                }
            });
        }
        else
            showDialog('Введенні невірні дані!');
    }
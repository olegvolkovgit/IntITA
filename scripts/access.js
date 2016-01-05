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

    function cancelTeacherAccess(url) {
        var teacherId = $("select[name=teacher] option:selected").val();
        var moduleId = $("select[name=module] option:selected").val();

        if(teacherId && moduleId)
        {
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    'module': moduleId,
                    'teacher' : teacherId
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
        else showDialog('Спочатку виберіть дані');

    }

    function selectTeacherModules(url) {
        var teacher = $('select[name="teacher"]').val();
        if (!teacher) {
            $('div[name="teacherModules"]').html('');
        } else {
            $.ajax({
                type: "POST",
                url: url,
                data: {teacher: teacher},
                cache: false,
                success: function (response) {
                    $('div[name="teacherModules"]').html(response);
                }
            });
        }
    }

    function changeUserStatus() {
        document.getElementById('').style.display = 'block';
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

    function selectLecture() {
        var module = $('select[name="module"]').val();
        $.ajax({
            type: "POST",
            url: "/_admin/permissions/showLectures",
            data: {module: module},
            cache: false,
            success: function (response) {
                $('div[name="selectLecture"]').html(response);
            }
        });
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


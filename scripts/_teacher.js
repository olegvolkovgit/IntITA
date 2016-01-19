function load(url, header) {
    clearDashboard();
    $.ajax({
        url: url,
        async: true,
        success: function (data) {
            container = $('#pageContainer');
            container.html('');
            container.html(data);
            if (header) {
                $("#pageTitle").html(header);
            } else {
                $("#pageTitle").html('Особистий кабінет');
            }
        },
        error: function () {
            showDialog();
        }
    });
}
function setTeacherRole(url)
{
    var role = $("select[name=role] option:selected").val();
    var teacher = $("#teacher").val();
    $.ajax({
        url: url,
        type : 'post',
        async: true,
        data: {role: role, teacher: teacher},
        success: function (data) {
            fillContainer(data);
        },
        error: function () {
            showDialog();
        }
    });
}


function clearDashboard() {
    if (document.getElementById("dashboard"))
        document.getElementById("dashboard").style.display = "none";
}

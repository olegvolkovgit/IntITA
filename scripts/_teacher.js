function load(url, header,histories) {
    clearDashboard();
    if(histories == undefined)
    {
       history.pushState({url : url,header:header},"");
    }
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
function reloadPage(event)
{
    if(event.state)
    {
        var path = history.state.url;
        var header = history.state.header;
        load(path,header,true);
    }
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

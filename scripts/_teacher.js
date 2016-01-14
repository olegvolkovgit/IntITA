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
       var path = history.state.url;
       var header = history.state.header;
        load(path,header,true);
}
function clearDashboard() {
    if (document.getElementById("dashboard"))
        document.getElementById("dashboard").style.display = "none";
}

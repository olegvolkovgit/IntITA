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

function clearDashboard() {
    if (document.getElementById("dashboard"))
        document.getElementById("dashboard").style.display = "none";
}


function loadPage(url){
    $.ajax({
        type: "POST",
        url: url,
        cache: false,
        success: function (data) {
            $("#pageContainer").html(data);
        }
    });
}
function send(url){
    clearDashboard();
    alert(url);

    var jsonData = {
        "user" : user,
        "subject" : document.getElementById("subject"),
        "text" : document.getElementById("text"),
        receivers: document.getElementById("receiver")
    };

    $.ajax({
        url: url,
        data: jsonData,
        method: post,
        success: function (data) {
            container = $('#pageContainer');

            container.html('');
            container.html(data);
        },
        error: function () {
            alert("Вибачте, але на сайті виникла помилка. " +
                "Спробуйте зайти до кабінету пізніше або зв'яжіться з адміністратором сайту.");
            //location.reload();
        }
    });
}
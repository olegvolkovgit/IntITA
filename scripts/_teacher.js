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

function loadPage(url, role) {
    $.ajax({
        url: url,
        success: function (data) {
            container = $('#pageContainer');
            container.html(data);
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

//Modal windows
function showDialog(str)
{
    if(str){
        $('#modalText').html(str);
    }
    $('#myModal').modal('show');
}

function send(url){
    clearDashboard();

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
            location.reload();
        }
    });
}

function sendMessage(url) {
    receiver = $("#typeahead").val();
    if (receiver === "") {
        bootbox.alert('Виберіть отримувача повідомлення.');
    } else{
        var posting = $.post(url,
            {
                "id" : $("input[name=id]").val(),
                "receiver" : receiver,
                "subject" : $("input[name=subject]").val(),
                "text": $("#text").val(),
                "scenario": "new"
            }
        );

        posting.done(function () {
                bootbox.alert("Ваше повідомлення успішно відправлено.", function (){
                    location.href = window.location.pathname;
                });
            })
            .fail(function () {
                bootbox.alert("Повідомлення не вдалося відправити. Спробуйте надіслати пізніше або " +
                    "напишіть на адресу antongriadchenko@gmail.com.", function (){
                    location.href = window.location.pathname;
                });
            });
    }
}


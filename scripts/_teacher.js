function load(url, header, histories) {
    clearDashboard();
    if (histories == undefined) {
        history.pushState({url: url, header: header}, "");
    }
    $jq.ajax({
        url: url,
        async: true,
        success: function (data) {
            container = $jq('#pageContainer');
            container.html('');
            container.html(data);
            if (header) {
                $jq("#pageTitle").html(header);
            } else {
                $jq("#pageTitle").html('Особистий кабінет');
            }
        },
        error: function () {
            showDialog();
        }
    });
}

function reloadPage(event) {
    if (event.state) {
        var path = history.state.url;
        var header = history.state.header;
        load(path, header, true);
    }
}

function setTeacherRole(url) {
    var role = $jq("select[name=role] option:selected").val();
    var teacher = $jq("#teacher").val();
    $jq.ajax({
        url: url,
        type: 'post',
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

function loadPage(url) {
    $jq.ajax({
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
function showDialog(str) {
    if (str) {
        $jq('#modalText').html(str);
    }
    $jq('#myModal').modal('show');
}

function send(url) {
    clearDashboard();

    var jsonData = {
        "user": user,
        "subject": document.getElementById("subject"),
        "text": document.getElementById("text"),
        receivers: document.getElementById("receiver")
    };

    $jq.ajax({
        url: url,
        data: jsonData,
        method: post,
        success: function (data) {
            container = $('#pageContainer');
            container.html('');
            container.html(data);
        },
        error: function () {
            showDialog();
            location.reload();
        }
    });
}

function sendMessage(url) {
    receiver = $jq("#typeahead").val();
    if (receiver === "") {
        bootbox.alert('Виберіть отримувача повідомлення.');
    } else {
        var posting = $jq.post(url,
            {
                "id": $jq("input[name=id]").val(),
                "receiver": receiver,
                "subject": $jq("input[name=subject]").val(),
                "text": $jq("#text").val(),
                "scenario": "new"
            }
        );

        posting.done(function () {
                bootbox.alert("Ваше повідомлення успішно відправлено.", function () {
                    location.href = window.location.pathname;
                });
            })
            .fail(function () {
                bootbox.alert("Повідомлення не вдалося відправити. Спробуйте надіслати пізніше або " +
                    "напишіть на адресу antongriadchenko@gmail.com.", function () {
                    location.href = window.location.pathname;
                });
            });
    }
}

function loadForm(url, receiver, scenario, message) {
    idBlock = "#collapse" + message;
    $jq(idBlock).collapse('show');
    id = "#form" + message;
    var command = {
        "user": user,
        "message": message,
        "receiver": receiver,
        "scenario": scenario
    };

    $jq.post(url, {form: JSON.stringify(command)}, function () {
        })
        .done(function (data) {
            $jq(id).empty();
            $jq(id).append(data);
        })
        .fail(function () {
            showDialog();
        })
        .always(function () {
            },
            "json"
        );
}



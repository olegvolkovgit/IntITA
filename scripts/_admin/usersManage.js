function sendNewAdminData(url) {
    user = $jq("#typeahead").val();
    if (user === "") {
        bootbox.alert('Виберіть користувача, якого потрібно призначити адміністратором.');
    } else {
        var posting = $jq.post(url, {user: user});
        posting.done(function (response) {
                if (response == 1) {
                    bootbox.alert("Користувач " + user + " призначений адміністратором.", function () {
                        location.href = window.location.pathname;
                    });
                }
                else {
                    bootbox.alert("Користувача " + user + " не вдалося призначити адміністратором. Спробуйте повторити " +
                        "операцію пізніше або напишіть на адресу antongriadchenko@gmail.com.", function () {
                        location.href = window.location.pathname;
                    });
                }
            })
            .fail(function () {
                bootbox.alert("Користувача " + user + " не вдалося призначити адміністратором. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу antongriadchenko@gmail.com.", function () {
                    location.href = window.location.pathname;
                });
            });
    }
}

function cancelAdmin(url, id, name) {
    var posting = $jq.post(url, {user: id});
    posting.done(function (response) {
            if (response == 1)
                bootbox.alert("Права адміністратора для користувача " + name + " відмінені.", loadUsersIndex);
            else {
                bootbox.alert("Права адміністратора для користувача " + name + " не вдалося відмінити. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу antongriadchenko@gmail.com.", loadUsersIndex);
            }
        })
        .fail(function () {
            bootbox.alert("Права адміністратора для користувача " + name + " не вдалося відмінити. Спробуйте повторити " +
                "операцію пізніше або напишіть на адресу antongriadchenko@gmail.com.", loadUsersIndex);
        });
}

function cancelAccountant(url, id, name) {
    var posting = $jq.post(url, {user: id});

    posting.done(function (response) {
            if (response == 1)
                bootbox.alert("Права бухгалтера для користувача " + name + " відмінені.", loadUsersIndex);
            else {
                bootbox.alert("Права бухгалтера для користувача " + name + " не вдалося відмінити. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу antongriadchenko@gmail.com.", loadUsersIndex);
            }
        })
        .fail(function () {
            bootbox.alert("Права бухгалтера для користувача " + name + " не вдалося відмінити. Спробуйте повторити " +
                "операцію пізніше або напишіть на адресу antongriadchenko@gmail.com.", loadUsersIndex);
        });
}

function sendNewAccountantData(url) {
    user = $jq("#typeahead").val();
    if (user === "") {
        bootbox.alert('Виберіть користувача, якого потрібно призначити бухгалтером.');
    } else {
        var posting = $jq.post(url, {user: user});

        posting.done(function (response) {
                if (response == 1)
                    bootbox.alert("Користувач " + user + " призначений бухгалтером.", function () {
                        location.href = window.location.pathname;
                    });
                else {
                    bootbox.alert("Користувача " + user + " не вдалося призначити бухгалтером. Спробуйте повторити " +
                        "операцію пізніше або напишіть на адресу antongriadchenko@gmail.com.", function () {
                        location.href = window.location.pathname;
                    });
                }
            })
            .fail(function () {
                bootbox.alert("Користувача " + user + " не вдалося призначити бухгалтером. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу antongriadchenko@gmail.com.", function () {
                    location.href = window.location.pathname;
                });
            });
    }
}

function loadUsersIndex(){
    load(basePath + '/_teacher/_admin/users/index');
}

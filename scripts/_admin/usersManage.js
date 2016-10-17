function assignRole(url, role, tab) {
    user = $jq("#userId").val();
    if (user == 0) {
        bootbox.alert('Виберіть користувача.');
    } else {
        var posting = $jq.post(url, {userId: user, role: role});
        posting.done(function (response) {
                bootbox.alert(response, function () {
                    loadUsersIndex(tab);
                });
            })
            .fail(function () {
                bootbox.alert("Користувачу не вдалося призначити обрану роль. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу " + adminEmail, loadUsersIndex);
            });
    }
}

function cancelRole(url, role, user, tab) {
    if (!user) {
        user = $jq("#userId").val();
    }
    if (user == 0) {
        bootbox.alert('Виберіть користувача.');
    } else {
        var posting = $jq.post(url, {userId: user, role: role});
        posting.done(function (response) {
                bootbox.alert(response, loadUsersIndex(tab));
            })
            .fail(function () {
                bootbox.alert("Користувачу не вдалося відмінити обрану роль. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу " + adminEmail, loadUsersIndex(tab));
            });
    }
}

function loadUsersIndex(tab) {
    if (tab == undefined) tab = 0;
    load(basePath + '/_teacher/_admin/users/index', 'Користувачі', '', tab);
}




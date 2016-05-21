function sendResponse(url, module, user) {
    teacher = $jq("#userId").val();
    if (teacher == 0) {
        bootbox.alert('Виберіть викладача.');
    } else {
        showAjaxLoader();
        var posting = $jq.post(url, {teacher: teacher, module: module, user: user});
        posting.done(function (response) {
                bootbox.alert(response, window.history.back());
            })
            .fail(function () {
                bootbox.alert("Запит не вдалося надіслати. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу " + adminEmail, window.history.back());
            });
        posting.always(function () {
                hideAjaxLoader();
            }
        );
    }
}


function assignTeacherConsultantModule(url, module) {
    var user = $jq("#userId").val();
    var sender = $jq("#sender").val();
    if (user == 0) {
        bootbox.alert('Виберіть викладача.');
    } else {
        var posting = $jq.post(url, {userId: user, module: module, user: sender});
        posting.done(function (response) {
                bootbox.alert(response, window.history.back());
            })
            .fail(function () {
                bootbox.alert("Викладачу не вдалося призначити обраний модуль. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу " + adminEmail, window.history.back());
            });
    }
}


function assignTeacherConsultantForStudent(url, student, module) {
    teacher = $jq("#teacherId").val();
    if (teacher == 0) {
        bootbox.alert('Виберіть викладача.');
    } else {
        var posting = $jq.post(url, {teacher: teacher, module: module, student: student});
        posting.done(function (response) {
                bootbox.alert(response, window.history.back());
            })
            .fail(function () {
                bootbox.alert("Викладачу не вдалося призначити обраний модуль. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу " + adminEmail, window.history.back());
            });
    }
}

function cancelTeacherConsultantForStudent(url, student, module) {
    teacher = $jq("#teacherId").val();
    var posting = $jq.post(url, {teacher: teacher, module: module, student: student});
    posting.done(function (response) {
            bootbox.alert(response, window.history.back());
        })
        .fail(function () {
            bootbox.alert("Операцію не вдалося виконати. Спробуйте повторити " +
                "операцію пізніше або напишіть на адресу " + adminEmail, window.history.back());
        });

}


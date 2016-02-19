$jq('#deleteModal').on('show.bs.modal', function(e) {
    var messageId = $jq(e.relatedTarget).data('message-id');
    $jq(e.currentTarget).find('input[name="messageId"]').val(messageId);
});

function deleteDialog(url, partner1, partner2) {
    var command = {
        "partner1": partner1,
        "partner2": partner2
    };

    $jq.post(url, {data: JSON.stringify(command)}, function () {
        })
        .done(function () {
            $jq("#deleteDialog").modal("hide");
            bootbox.alert("Діалог успішно видалено.");
            load(basePath + '/_teacher/messages/index', 'Листування');
        })
        .fail(function () {
            bootbox.alert("На сайті виникла помилка.\n" +
                "Спробуйте перезавантажити сторінку або напишіть нам на адресу " + adminEmail);
        })
        .always(function () {
            },
            "json"
        );
}

function deleteMessage(url, receiver) {
    var command = {
        "message": $jq('input[name="messageId"]').val(),
        "receiver": receiver
    };

    $jq.post(url, {data: JSON.stringify(command)}, function () {
        })
        .done(function () {
            $jq("#deleteModal").modal("hide");
            location.reload();
        })
        .fail(function () {
            showDialog();
            location.reload();
        })
        .always(function () {
            },
            "json"
        );
}

function reset(message) {
    id = "#messageForm" + message;
    $jq(id).remove();
}
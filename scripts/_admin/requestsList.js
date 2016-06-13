function setRequestStatus(url, message) {
    bootbox.confirm(message, function (result) {
        if (result) {
            $jq.ajax({
                url: url,
                type: "POST",
                success: function (response) {
                    bootbox.alert(response, function () {
                        load(basePath + '/_teacher/_admin/request/index', 'Запити');
                    });
                },
                error: function () {
                    bootbox.alert("Операцію не вдалося виконати.");
                }
            });
        } else {
            bootbox.alert("Операцію відмінено.");
        }
    });
}

function approveCoworkerRequest(url, message, user){
    showAjaxLoader();
    $jq.ajax({
        url: url,
        type: "POST",
        data: {message: message, user: user},
        success: function (response) {
            bootbox.alert(response, function () {
                load(basePath + '/_teacher/_admin/request/index', 'Запити');
            });
        },
        error: function () {
            bootbox.alert("Операцію не вдалося виконати.");
        },
        complete: function(){
            hideAjaxLoader();
        }
    });
}
function initDirectory(url){
    $jq.ajax({
        url: url,
        type: "POST",
        success: function () {
            bootbox.confirm("Операцію успішно виконано.", function () {
                load(basePath + "/_teacher/_admin/verifyContent/index");
            });
        },
        error: function (){
            showDialog();
        }
    });
}

function initWaitLectures(){
    $jq('#waitLecturesTable').DataTable({
        "ajax": {
            "url": basePath + "/_teacher/_admin/verifyContent/waitLecturesList",
            "dataSrc": "data"
        },
        "columns": [
            null,
            {className: "center"},
            {className: "center"},
            null,
            null],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
            console.log($jq(row).attr('class'));
        },
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function initVerifiedLectures(){
    $jq('#verifiedLecturesTable').DataTable({
        "ajax": {
            "url": basePath + "/_teacher/_admin/verifyContent/verifiedLecturesList",
            "dataSrc": "data"
        },
        "columns": [
            null,
            {className: "center"},
            {className: "center"},
            null,
            null],
        "createdRow": function (row, data, index) {
            $jq(row).addClass('gradeX');
            console.log($jq(row).attr('class'));
        },
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    });
}

function setVerifyStatus(url, question){
    bootbox.confirm(question, function(result) {
        if (result != null) {
            $jq.ajax({
                url: url,
                type: "POST",
                success: function () {
                    bootbox.confirm("Операцію успішно виконано.", function () {
                        load(basePath + "/_teacher/_admin/verifyContent/index");
                    });
                }
            });
        } else {
            showDialog("Операцію не вдалося виконати.");
        }
    });
}

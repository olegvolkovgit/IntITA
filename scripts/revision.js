function addButtons(treeData) {
    "use strict";

    var treeButtons = {
        "title": "Дії",
        "actions": [
            {
                "type": "button",
                "title": "Створити нову ревізію",
                "action": function(event) {
                    var idRevision = $(event.data.el).attr('id');
                    createRevision(idRevision);
                }
            },
            {
                "type": "button",
                "title": "Переглянути",
                "action": function(event) {
                    var idRevision = $(event.data.el).attr('id');
                    previewRevision(idRevision);
                }
            },
            {
                "type": "button",
                "title": "Редагувати",
                "action": function(event) {
                    var idRevision = $(event.data.el).attr('id');
                    editRevision(idRevision);
                }
            },
            {
                "type": "button",
                "title": "Відправити на затвердження",
                "action": function(event) {
                    var idRevision = $(event.data.el).attr('id');
                    sendRevision(idRevision);
                }
            },
            {
                "type": "button",
                "title": "Скасувати відправлення на затвердження",
                "action": function(event) {
                    var idRevision = $(event.data.el).attr('id');
                    cancelSendRevision(idRevision);
                }
            },
            {
                "type": "button",
                "title": "Затвердити",
                "action": function(event) {
                    var idRevision = $(event.data.el).attr('id');
                    approve(idRevision);
                }
            },
            {
                "type": "button",
                "title": "Відхилити",
                "action": function(event) {
                    var idRevision = $(event.data.el).attr('id');
                    reject(idRevision);
                }
            },
            {
                "type": "button",
                "title": "Скасувати",
                "action": function(event) {
                    var idRevision = $(event.data.el).attr('id');
                    cancel(idRevision);
                }
            }
        ]
    };

    $.each(treeData, function(k, v) {
        v['ddbutton'] = treeButtons;

        if (v['nodes']) {
            addButtons(v['nodes']);
        }
    });
}
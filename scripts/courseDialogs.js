bootbox.addLocale('uk', { OK: 'Добре', CANCEL: 'Ні', CONFIRM: 'Так' });
bootbox.addLocale('ru', { OK: 'Хорошо', CANCEL: 'Нет', CONFIRM: 'Да' });
bootbox.addLocale('en', { OK: 'OK', CANCEL: 'Cancel', CONFIRM: 'Yes' });
bootbox.setLocale(lang);

function deleteModule(idModule){
    var msg;
    switch (lang) {
        case 'uk':
            msg='Ти впевнений, що хочеш видалити даний модуль?';
            break;
        case 'ru':
            msg='Ты уверен, что хочешь удалить данный модуль?';
            break;
        case 'en':
            msg='Are you sure you want to remove this module?';
            break;
        default:
            msg='Ти впевнений, що хочеш видалити даний модуль?';
            break;
    }

    bootbox.confirm(msg, function(result){
        if(result){
            $.ajax({
                type: "GET",
                url: "/course/unableModule",
                data: {'idModule':idModule,'idCourse':idCourse},
                success: function(){
                    $.fn.yiiGridView.update("modules-grid");
                }
            });
        };
    })
}
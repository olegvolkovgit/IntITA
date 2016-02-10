/**
 * Created by Wizlight on 07.01.2016.
 */
bootbox.addLocale('uk', { OK: 'Добре', CANCEL: 'Ні', CONFIRM: 'Так' });
bootbox.addLocale('ru', { OK: 'Хорошо', CANCEL: 'Нет', CONFIRM: 'Да' });
bootbox.addLocale('en', { OK: 'OK', CANCEL: 'Cancel', CONFIRM: 'Yes' });
bootbox.setLocale(lang);

function deleteLecture(idLecture, idModule){
    var msg;
    switch (lang) {
        case 'uk':
            msg='Ти впевнений, що хочеш видалити дане заняття?';
            break;
        case 'ru':
            msg='Ты уверен, что хочешь удалить данное занятие?';
            break;
        case 'en':
            msg='Are you sure you want to remove this lecture?';
            break;
        default:
            msg='Ти впевнений, що хочеш видалити дане заняття?';
            break;
    }

    bootbox.confirm(msg, function(result){
        if(result){
            $.ajax({
                type: "GET",
                url: "/module/unableLesson",
                data: {'idLecture':idLecture, 'idModule':idModule},
                success: function(){
                    $.fn.yiiGridView.update("lectures-grid");
                }
            });
        };
    })
}
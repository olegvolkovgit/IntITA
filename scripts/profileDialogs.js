/**
 * Created by Wizlight on 07.01.2016.
 */
bootbox.addLocale('uk', { OK: 'Добре', CANCEL: 'Ні', CONFIRM: 'Так' });
bootbox.addLocale('ru', { OK: 'Хорошо', CANCEL: 'Нет', CONFIRM: 'Да' });
bootbox.addLocale('en', { OK: 'OK', CANCEL: 'Cancel', CONFIRM: 'Yes' });
bootbox.setLocale(lang);

function deleteConsultation(url){
    var msg;
    switch (lang) {
        case 'uk':
            msg='Ти впевнений, що хочеш відмінити консультацію?';
            break;
        case 'ru':
            msg='Ты уверен, что хочешь отменить консультацию?';
            break;
        case 'en':
            msg='Are you sure You want to cancel the consultation?';
            break;
        default:
            msg='Ти впевнений, що хочеш відмінити консультацію?';
            break;
    }

    bootbox.confirm(msg, function(result){
        if(result){
            $.ajax({
                type: "GET",
                url: url,
                success: function(){
                    $.fn.yiiGridView.update("consultation-grid");
                }
            });
        };
    })
}
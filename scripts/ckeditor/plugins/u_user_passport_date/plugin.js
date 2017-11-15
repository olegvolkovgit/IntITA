CKEDITOR.plugins.add('u_user_passport_date',{
    init: function(editor){
        var cmd = editor.addCommand('u_user_passport_date', {
            exec:function(editor){
                editor.insertHtml('<span u-user-passport-date><b><i>*паспорт_дата*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('u_user_passport_date',{
            label: 'Замовник - дата видачі паспорта',
            command: 'u_user_passport_date',
        });
    },
});
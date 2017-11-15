CKEDITOR.plugins.add('u_user_passport',{
    init: function(editor){
        var cmd = editor.addCommand('u_user_passport', {
            exec:function(editor){
                editor.insertHtml('<span u-user-passport><b><i>*паспорт_замовника*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('u_user_passport',{
            label: 'Замовник - номер паспорта',
            command: 'u_user_passport',
        });
    },
});
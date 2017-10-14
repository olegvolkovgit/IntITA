CKEDITOR.plugins.add('u_user_passport_issued',{
    init: function(editor){
        var cmd = editor.addCommand('u_user_passport_issued', {
            exec:function(editor){
                editor.insertHtml('<span u-user-passport-issued><b><i>*паспорт_виданий*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('u_user_passport_issued',{
            label: 'Замовник - паспорт виданий',
            command: 'u_user_passport_issued',
        });
    },
});
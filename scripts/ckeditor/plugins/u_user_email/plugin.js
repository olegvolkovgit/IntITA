CKEDITOR.plugins.add('u_user_email',{
    init: function(editor){
        var cmd = editor.addCommand('u_user_email', {
            exec:function(editor){
                editor.insertHtml('<span u-user-email><b><i>*email_замовника*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('u_user_email',{
            label: 'Email замовника',
            command: 'u_user_email',
        });
    },
});
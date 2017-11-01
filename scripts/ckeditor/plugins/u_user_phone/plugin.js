CKEDITOR.plugins.add('u_user_phone',{
    init: function(editor){
        var cmd = editor.addCommand('u_user_phone', {
            exec:function(editor){
                editor.insertHtml('<span u-user-phone><b><i>*телефон_замовника*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('u_user_phone',{
            label: 'Телефон замовника',
            command: 'u_user_phone',
        });
    },
});
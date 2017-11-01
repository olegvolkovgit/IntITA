CKEDITOR.plugins.add('u_user_inn',{
    init: function(editor){
        var cmd = editor.addCommand('u_user_inn', {
            exec:function(editor){
                editor.insertHtml('<span u-user-inn><b><i>*код_замовника*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('u_user_inn',{
            label: 'Замовник - код',
            command: 'u_user_inn',
        });
    },
});
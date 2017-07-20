CKEDITOR.plugins.add('u_user_doc',{
    init: function(editor){
        var cmd = editor.addCommand('u_user_doc', {
            exec:function(editor){
                editor.insertHtml('<span u-user-doc><b><i>*замовник_та_дані_документів*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('u_user_doc',{
            label: 'Замовник та дані документів',
            command: 'u_user_doc',
        });
    },
});
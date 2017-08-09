CKEDITOR.plugins.add('u_user_data_address',{
    init: function(editor){
        var cmd = editor.addCommand('u_user_data_address', {
            exec:function(editor){
                editor.insertHtml('<span u-user-data-address><b><i>*замовник_дані_документів_адресса*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('u_user_data_address',{
            label: 'Замовник, його документи та адресса',
            command: 'u_user_data_address',
        });
    },
});
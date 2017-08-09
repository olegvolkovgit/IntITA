CKEDITOR.plugins.add('u_name',{
    init: function(editor){
        var cmd = editor.addCommand('u_name', {
            exec:function(editor){
                editor.insertHtml('<span u-name><b><i>*ім\'я_замовника*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('u_name',{
            label: 'Ім\'я замовника',
            command: 'u_name',
        });
    },
});
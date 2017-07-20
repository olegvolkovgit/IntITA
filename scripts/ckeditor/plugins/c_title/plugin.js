CKEDITOR.plugins.add('c_title',{
    init: function(editor){
        var cmd = editor.addCommand('c_title', {
            exec:function(editor){
                editor.insertHtml('<span c-title><b><i>*назва_компанії*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('c_title',{
            label: 'Назва компанії',
            command: 'c_title',
        });
    },
});
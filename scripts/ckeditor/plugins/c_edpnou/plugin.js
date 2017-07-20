CKEDITOR.plugins.add('c_edpnou',{
    init: function(editor){
        var cmd = editor.addCommand('c_edpnou', {
            exec:function(editor){
                editor.insertHtml('<span c-edpnou><b><i>*EDPNOU_компанії*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('c_edpnou',{
            label: 'EDPNOU компанії',
            command: 'c_edpnou',
        });
    },
});
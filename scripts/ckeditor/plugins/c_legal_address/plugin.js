CKEDITOR.plugins.add('c_legal_address',{
    init: function(editor){
        var cmd = editor.addCommand('c_legal_address', {
            exec:function(editor){
                editor.insertHtml('<span c-legal-address><b><i>*адреса_компанії*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('c_legal_address',{
            label: 'Адреса компанії',
            command: 'c_legal_address',
        });
    },
});
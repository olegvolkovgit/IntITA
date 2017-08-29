CKEDITOR.plugins.add('a_invoices',{
    init: function(editor){
        var cmd = editor.addCommand('a_invoices', {
            exec:function(editor){
                editor.insertHtml('<span a-invoices=""><b><i>*рахунки_та_ціни*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('a_invoices',{
            label: 'Рахунки та ціни',
            command: 'a_invoices',
        });
    },
});
CKEDITOR.plugins.add('c_bank_name',{
    init: function(editor){
        var cmd = editor.addCommand('c_bank_name', {
            exec:function(editor){
                editor.insertHtml('<span c-bank-name><b><i>*назва_банка*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('c_bank_name',{
            label: 'Назва банка',
            command: 'c_bank_name',
        });
    },
});
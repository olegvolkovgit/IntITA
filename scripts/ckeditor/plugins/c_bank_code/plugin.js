CKEDITOR.plugins.add('c_bank_code',{
    init: function(editor){
        var cmd = editor.addCommand('c_bank_code', {
            exec:function(editor){
                editor.insertHtml('<span c-bank-code><b><i>*номер_банка*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('c_bank_code',{
            label: 'Номер банка',
            command: 'c_bank_code',
        });
    },
});
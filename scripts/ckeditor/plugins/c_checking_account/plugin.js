CKEDITOR.plugins.add('c_checking_account',{
    init: function(editor){
        var cmd = editor.addCommand('c_checking_account', {
            exec:function(editor){
                editor.insertHtml('<span c-bank-name><b><i>*Р/р_банка*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('c_checking_account',{
            label: 'Р/р банка',
            command: 'c_checking_account',
        });
    },
});
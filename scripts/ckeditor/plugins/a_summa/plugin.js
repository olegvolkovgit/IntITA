CKEDITOR.plugins.add('a_summa',{
    init: function(editor){
        var cmd = editor.addCommand('a_summa', {
            exec:function(editor){
                editor.insertHtml('<span a-summa><b><i>*ціна_сервіса*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('a_summa',{
            label: 'Ціна сервіса',
            command: 'a_summa',
        });
    },
});
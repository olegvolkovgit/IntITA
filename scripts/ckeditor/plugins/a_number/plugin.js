CKEDITOR.plugins.add('a_number',{
    init: function(editor){
        var cmd = editor.addCommand('a_number', {
            exec:function(editor){
                editor.insertHtml('<span a-number><b><i>*номер_договора*</b></i></spana>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('a_number',{
            label: 'Номер договора',
            command: 'a_number',
        });
    },
    // icons:'', // иконка
});
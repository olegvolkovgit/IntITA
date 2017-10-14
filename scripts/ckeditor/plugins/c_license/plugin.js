CKEDITOR.plugins.add('c_license',{
    init: function(editor){
        var cmd = editor.addCommand('c_license', {
            exec:function(editor){
                editor.insertHtml('<span c-license><b><i>*номер_ліцензії*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('c_license',{
            label: 'Номер ліцензії',
            command: 'c_license',
        });
    },
});
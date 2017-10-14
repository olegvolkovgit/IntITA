CKEDITOR.plugins.add('c_representative_short_name',{
    init: function(editor){
        var cmd = editor.addCommand('c_representative_short_name', {
            exec:function(editor){
                editor.insertHtml('<span c-representative-short-name><b><i>*ім\'я_представника_ініціали*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('c_representative_short_name',{
            label: 'Ім\'я представника(ініціали)',
            command: 'c_representative_short_name',
        });
    },
});
CKEDITOR.plugins.add('c_representatives_data',{
    init: function(editor){
        var cmd = editor.addCommand('c_representatives_data', {
            exec:function(editor){
                editor.insertHtml('<span c-representatives-data><b><i>*представники_та_їх_дані*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('c_representatives_data',{
            label: 'Представники та їх дані',
            command: 'c_representatives_data',
        });
    },
});
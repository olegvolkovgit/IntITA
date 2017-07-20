CKEDITOR.plugins.add('a_date',{
    init: function(editor){
        var cmd = editor.addCommand('a_date', {
            exec:function(editor){
                editor.insertHtml('<span a-date><b><i>*дата_укладення*</b></i></spana>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('a_date',{
            label: 'Дата укладення',
            command: 'a_date',
        });
    },
});
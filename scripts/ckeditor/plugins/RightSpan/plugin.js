CKEDITOR.plugins.add('RightSpan',{
    init: function(editor){
        var cmd = editor.addCommand('RightSpan', {
            exec:function(editor){
                editor.insertHtml('<span style="float:right">'+editor.getSelection().getSelectedText()+'</span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('RightSpan',{
            label: 'По правому краю',
            command: 'RightSpan',
        });
    },
});
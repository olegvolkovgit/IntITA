CKEDITOR.plugins.add('a_description',{
    init: function(editor){
        var cmd = editor.addCommand('a_description', {
            exec:function(editor){
                editor.insertHtml('<span a-description><b><i>*назва_сервісу*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('a_description',{
            label: 'Назва сервісу',
            command: 'a_description',
        });
    },
});
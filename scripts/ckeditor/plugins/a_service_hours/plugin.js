CKEDITOR.plugins.add('a_service_hours',{
    init: function(editor){
        var cmd = editor.addCommand('a_service_hours', {
            exec:function(editor){
                editor.insertHtml('<span a-service-hours=""><b><i>*модулі_та_їх_години*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('a_service_hours',{
            label: 'Модулі та їх години',
            command: 'a_service_hours',
        });
    },
});
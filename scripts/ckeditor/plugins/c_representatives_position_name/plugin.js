CKEDITOR.plugins.add('c_representatives_position_name',{
    init: function(editor){
        var cmd = editor.addCommand('c_representatives_position_name', {
            exec:function(editor){
                editor.insertHtml('<span c-representatives-position-name><b><i>*представники_посади_імена*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('c_representatives_position_name',{
            label: 'Представники: посада_ім\'я',
            command: 'c_representatives_position_name',
        });
    },
});
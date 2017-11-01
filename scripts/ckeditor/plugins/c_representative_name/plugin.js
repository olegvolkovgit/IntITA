CKEDITOR.plugins.add('c_representative_name',{
    init: function(editor){
        var cmd = editor.addCommand('c_representative_name', {
            exec:function(editor){
                editor.insertHtml('<span c-representative-name><b><i>*ім\'я_представника_н_в*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('c_representative_name',{
            label: 'Ім\'я представника(н.в.)',
            command: 'c_representative_name',
        });
    },
});
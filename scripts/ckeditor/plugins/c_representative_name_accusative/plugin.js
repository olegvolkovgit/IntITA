CKEDITOR.plugins.add('c_representative_name_accusative',{
    init: function(editor){
        var cmd = editor.addCommand('c_representative_name_accusative', {
            exec:function(editor){
                editor.insertHtml('<span c-representative-name-accusative><b><i>*ім\'я_представника_р_в*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('c_representative_name_accusative',{
            label: 'Ім\'я представника(р.в.)',
            command: 'c_representative_name_accusative',
        });
    },
});
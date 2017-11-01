CKEDITOR.plugins.add('c_representative_position_accusative',{
    init: function(editor){
        var cmd = editor.addCommand('c_representative_position_accusative', {
            exec:function(editor){
                editor.insertHtml('<span c-representative-position-accusative><b><i>*посада_представника_р_в*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('c_representative_position_accusative',{
            label: 'Посада представника(р.в.)',
            command: 'c_representative_position_accusative',
        });
    },
});
CKEDITOR.plugins.add('c_license_issued_date',{
    init: function(editor){
        var cmd = editor.addCommand('c_license_issued_date', {
            exec:function(editor){
                editor.insertHtml('<span c-license-issued-date><b><i>*дата_видачі_ліцензії*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('c_license_issued_date',{
            label: 'Дата видачі ліцензії',
            command: 'c_license_issued_date',
        });
    },
});
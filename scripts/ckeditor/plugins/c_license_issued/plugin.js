CKEDITOR.plugins.add('c_license_issued',{
    init: function(editor){
        var cmd = editor.addCommand('c_license_issued', {
            exec:function(editor){
                editor.insertHtml('<span c-license-issued><b><i>*ким_видано_ліцензію*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('c_license_issued',{
            label: 'Ліцензію видано(ким)',
            command: 'c_license_issued',
        });
    },
});
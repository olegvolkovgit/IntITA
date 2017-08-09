CKEDITOR.plugins.add('c_contacts',{
    init: function(editor){
        var cmd = editor.addCommand('c_contacts', {
            exec:function(editor){
                editor.insertHtml('<span c-contacts><b><i>*контакти_компанії*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('c_contacts',{
            label: 'Контакти компанії',
            command: 'c_contacts',
        });
    },
});
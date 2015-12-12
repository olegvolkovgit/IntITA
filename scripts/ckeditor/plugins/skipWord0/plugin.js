/**
 * Created by Wizlight on 24.11.2015.
 */
CKEDITOR.plugins.add('skipWord0',{
    init: function(editor){
        var cmd = editor.addCommand('skipWord0', {
            exec:function(editor){
                editor.insertHtml('<span skip="3:0" style="background:deeppink">'+editor.getSelection().getSelectedText()+'</span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('skipWord0',{
            label: 'Пропущене слово. Регістро залежне',
            command: 'skipWord0',
        });
    },
    icons:'skipWord0', // иконка
});
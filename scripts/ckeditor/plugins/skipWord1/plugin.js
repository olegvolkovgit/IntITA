/**
 * Created by Wizlight on 24.11.2015.
 */
CKEDITOR.plugins.add('skipWord1',{
    init: function(editor){
        var cmd = editor.addCommand('skipWord1', {
            exec:function(editor){
                editor.insertHtml('<span skip="3:1" style="background:greenyellow">'+editor.getSelection().getSelectedText()+'</span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('skipWord1',{
            label: 'Пропущене слово. Регістро незалежне',
            command: 'skipWord1',
        });
    },
    icons:'skipWord1', // иконка
});
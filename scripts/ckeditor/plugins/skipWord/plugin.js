/**
 * Created by Wizlight on 24.11.2015.
 */
CKEDITOR.plugins.add('skipWord',{
    init: function(editor){
        var cmd = editor.addCommand('skipWord', {
            exec:function(editor){
                editor.insertHtml('<span skip="true" style="background:yellowgreen">'+editor.getSelection().getSelectedText()+'</span>'); // собственно сама работа плагина
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('skipWord',{
            label: 'Пропущене слово',
            command: 'skipWord',
        });
    },
    icons:'skipWord', // иконка
});
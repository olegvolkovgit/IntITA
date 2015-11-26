/**
 * Created by Wizlight on 24.11.2015.
 */
CKEDITOR.plugins.add('skipWord',{
    init: function(editor){
        var cmd = editor.addCommand('skipWord', {
            exec:function(editor){
                var str = editor.getData();
                var count = (str.split('<span skip="').length - 1)
                count++;
                editor.insertHtml('<span skip="'+count+':1" style="background:yellow">'+editor.getSelection().getSelectedText()+'</span');
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
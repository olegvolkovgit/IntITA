CKEDITOR.plugins.add('a_sum_string',{
    init: function(editor){
        var cmd = editor.addCommand('a_sum_string', {
            exec:function(editor){
                editor.insertHtml('<span a-sum-string><b><i>*ціна_сервіса_прописом*</b></i></span>');
            }
        });
        cmd.modes = { wysiwyg : 1, source: 1 };// плагин будет работать и в режиме wysiwyg и в режиме исходного текста
        editor.ui.addButton('a_sum_string',{
            label: 'Ціна сервіса прописом',
            command: 'a_sum_string',
        });
    },
});
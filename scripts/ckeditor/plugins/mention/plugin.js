(function(jQuery) {
    CKEDITOR.plugins.add('mention', {
        icons: '',
        init: function(editor) {

            editor.on('contentDom', function(e) {
                var editable = editor.editable();

                editable.attachListener(editable, 'keydown', window.onInputBoxKeyDown);
                //editable.attachListener(editable, 'keypress', onInputBoxKeyPress);
                editable.attachListener(editable, 'input', window.onInputBoxInput);
                editable.attachListener(editable, 'click', window.onInputBoxClick);
            });

        },
    });

})(jQuery);
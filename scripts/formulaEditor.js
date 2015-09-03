/**
 * Created by Wizlight on 01.09.2015.
 */
$(function () {
    var $content = $('[data-target="insert"]'),
        $source = $('[data-source="insert"]');

    $(document).on('click', '[data-action="insert"]', function() {
        $content.trigger('focus');
        insertHTML($source.val());
    });
});

function insertHTML(html) {
    try {
        $('[data-target="insert"]').focus();
        if($("#inlineFormula").prop("checked")){
            html = html.replace("\\[","$");
            html = html.replace("\\]","$");
        }
        var selection = window.getSelection(),
            range = selection.getRangeAt(0),
            temp = document.createElement('div'),
            insertion = document.createDocumentFragment();

        temp.innerHTML = html;

        while (temp.firstChild) {
            insertion.appendChild(temp.firstChild);
        }

        range.deleteContents();
        range.insertNode(insertion);
        $('#newTextBlock').val($('[data-target="insert"]').html());
    } catch (z) {
        try {
            document.selection.createRange().pasteHTML(html);
        } catch (z) {}
    }
}
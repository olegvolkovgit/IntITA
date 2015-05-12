/**
 * Created by Ivanna on 12.05.2015.
 */


function pressEditRedactor(className, edit, cancel, save)
{
    var selector = className;
    $(selector).redactor({
        focus: true
    });
    $('#'+edit).hide();
    $('#'+cancel).show();
    $('#'+save).show();
}

function pressCancelRedactor(className, edit, cancel, save)
{
    var selector = className;
    $(selector).redactor('core.destroy');
    $('#'+edit).show();
    $('#'+cancel).hide();
    $('#'+save).hide();
}

function pressSaveRedactor(className, property, edit, cancel, save) {

    var selector = className;

    // save content
    var text = $(selector).redactor('code.get');
    if (property == 'txtMsgFirst'){
        textFirst = text;
    } else {
        if (property == 'txtMsgSecond'){
            textSecond = text;
        }
    }

    // destroy editor
    $(selector).redactor('core.destroy');
    $('#'+edit).show();
    $('#'+cancel).hide();
    $('#'+save).hide();
}

function getContent() {
    var textFirst = '';
    var textSecond = '';
    var firstText = document.getElementById('firstText');
    firstText.value = textFirst;
    var secondText = document.getElementById('secondText');
    secondText.value = textSecond;

}

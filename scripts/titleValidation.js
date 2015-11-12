/**
 * Created by Wizlight on 25.10.2015.
 */
function validateComments(input, text) {
    var rgx = new RegExp(input.pattern);
    if (!rgx.test(input.value)) {
        input.setCustomValidity(text);
    }
    else {
        input.setCustomValidity("");
    }
}
function validateRequired(input, text) {
    input.setCustomValidity(text);
}
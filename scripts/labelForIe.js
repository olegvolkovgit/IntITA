/**
 * Created by Wizlight on 20.03.2016.
 */
$(document).ready(function() {
    $("label").click(function () {
        if ($(this).attr("for") != "")
            $("#" + $(this).attr("for")).click();
    });
});
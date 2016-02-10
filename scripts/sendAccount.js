$(function () {
    schema = $.cookie('courseSchema');
    if (schema > 0) {
        $('input:radio[name="payment"]').filter('[value="' + schema + '"]').attr('checked', true);
    } else {
        $('input:radio[name="payment"]').filter('[value="1"]').attr('checked', true);
    }
});
function printAccount(user, course) {
    var summaNum = $("input[name='payment']:checked").val();
    $.ajax({
        type: "POST",
        url: basePath + "/payments/newAccount",
        data: {
            'user': user,
            'module': '0',
            'course': course,
            'summaNum': summaNum
        },
        cache: false,
        success: function (data) {
            location.href = basePath + '/payments/index?account=' + data;
        }
    });
}
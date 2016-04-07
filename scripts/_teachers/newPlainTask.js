/**
 * Created by Quicks on 10.12.2015.
 */

function markPlainTask(url) {
    var id = $jq('#plainTaskId').val();
    var mark = $jq('#mark').val();
    var comment = $jq('[name = comment]').val();
    var userId = $jq('#userId').val();
    $jq.ajax({
        url: url,
        type: "POST",
        data: {'idPlainTask': id, 'mark': mark, 'comment': comment, 'userId': userId},
        success: function () {
            showDialog('Ваша оцінка записана в базу');
        },
        error: function () {
            showDialog();
        },
        complete: function () {
            location.reload();
        }
    });

}

function fillContainer(data) {
    container = $jq('#pageContainer');
    container.html('');
    container.html(data);
}


<div class="modal fade" id="deleteDialog" tabindex="-1" role="dialog" aria-labelledby="Видалити діалог"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Видалити діалог</h4>
            </div>
            <div class="modal-body">
                Ви впевнені, що хочете видалити цей діалог?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Відмінити</button>
                <button type="button" class="btn btn-primary" onclick="deleteDialog(
                    '<?=Yii::app()->createUrl("/_teacher/messages/deleteAll");?>',
                    '<?=$message;?>',
                    '<?=$user;?>')">
                    Так
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    function deleteDialog(url, message, receiver) {
        var command = {
            "message": message,
            "receiver": receiver
        };

        $.post(url, {data: JSON.stringify(command)}, function () {
            })
            .done(function (data) {
                $("#deleteDialog").modal("hide");
                location.reload();
            })
            .fail(function () {
                alert("На сайті виникла помилка.\n" +
                    "Спробуйте перезавантажити сторінку або напишіть нам на адресу Wizlightdragon@gmail.com.");
            })
            .always(function () {
                },
                "json"
            );
    }
</script>
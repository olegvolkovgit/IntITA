<div class="modal fade" id="notifyModal" tabindex="-1" role="dialog" aria-labelledby="Повідомлення"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Відправлено</h4>
            </div>
            <div class="modal-body">
                Ваше повідомлення успішно відправлено.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Відмінити</button>
                <button type="button" class="btn btn-primary" onclick="okClose()">
                    Так
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function okClose() {
        $("#notifyModal").modal("hide");
    }
</script>
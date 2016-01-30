<?php
/** @var $user integer
 * @var $scenario string
 * @var $message int
 * @var $receiver int
 */
?>
<div id="messageForm<?=$message;?>">
    <form role="form" method="post" action="<?php echo Yii::app()->createUrl('messages/'.$scenario); ?>"
          id="message">
        <input class="form-control" name="id" id="hidden" value="<?=$user;?>">
        <input class="form-control" name="scenario" id="hidden" value="<?=$scenario;?>">
        <input class="form-control" name="receiver" id="hidden" value="<?=$receiver;?>">
        <input class="form-control" name="parent" id="hidden" value="<?=$message;?>">
        <input class="form-control" name="subject" placeholder="Тема">
        <br>
        <div class="form-group">
            <textarea class="form-control" rows="6" name="text" placeholder="Лист" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            Написати
        </button>
    </form>

        <button type="button" class="btn btn-default" onclick="reset(<?=$message;?>);" style="margin-top: -56px; margin-left: 100px">
            Скасувати
        </button>

</div>

<script>
    function reset(message) {
        id = "#messageForm" + message;
        $(id).remove();
    }
</script>




<?php
/** @var $user integer
 * @var $message int
 * @var $receiver int
 * @var $subject string
 */
?>
<div id="messageForm<?=$message;?>">
    <form role="form" id="messageForm<?=$message;?>">
        <input class="form-control" name="receiver" id="hidden" value="<?=$receiver;?>">
        <input class="form-control" name="parent" id="hidden" value="<?=$message;?>">
        <input class="form-control" name="subject" placeholder="Тема" autofocus
               value="<?=(substr($subject, 0, strlen("Re: ")) === "Re: ")?$subject:"Re: ".$subject;?>">
        <br>
        <div class="form-group">
            <textarea class="form-control" rows="6" id="text" name="text" placeholder="Лист" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary"
                onclick="reply('<?php echo Yii::app()->createUrl('/_teacher/messages/reply'); ?>'); return false;">
            Написати
        </button>
    </form>

    <button type="button" class="btn btn-default" onclick="reset(<?=$message;?>); return false;" style="margin-top: -56px; margin-left: 100px">
        Скасувати
    </button>
</div>
<script>
    var users = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/messages/usersByQuery?query=%QUERY&id=' + user,
            wildcard: '%QUERY'
        }
    });

    users.initialize();

    $jq('#typeahead').typeahead(null, {
        name: 'users',
        display: 'value',
        limit: 10,
        source: users
    });
</script>




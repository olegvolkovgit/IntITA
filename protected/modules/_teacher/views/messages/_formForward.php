<?php
/** @var $user integer
 * @var $message int
 * @var $receiver int
 */
?>
<div id="messageForm<?=$message;?>">
    <form role="form" method="post" action="<?php echo Yii::app()->createUrl('messages/forward'); ?>"
          id="message">
        <input class="form-control" name="id" id="hidden" value="<?=$user;?>">
        <input class="form-control" name="receiver" id="hidden" value="<?=$receiver;?>">
        <input class="form-control" name="parent" id="hidden" value="<?=$message;?>">
        <div class="form-group">
            <input id="typeahead" type="text" class="form-control" name="forwardTo" placeholder="Отримувач" size="135"
                   required>
        </div>

        <button type="submit" class="btn btn-primary">
            Написати
        </button>
    </form>

        <button type="button" class="btn btn-default" onclick="reset(<?=$message;?>);" style="margin-top: -56px; margin-left: 100px">
            Скасувати
        </button>

</div>
<script src="<?= StaticFilesHelper::fullPathTo('js', 'typeahead.js'); ?>"></script>
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
        source: users
    });

    function reset(message) {
        id = "#messageForm" + message;
        $jq(id).remove();
    }
</script>




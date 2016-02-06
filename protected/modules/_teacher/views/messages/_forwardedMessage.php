<?php
/**
 * @var $message UserMessages
 * @var $forwarded UserMessages
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <em><?= CommonHelper::formatMessageDate($forwarded->message0->create_date).", користувач <strong>".$forwarded->message0->sender0->userName() .
            ", " . $forwarded->message0->sender0->email . "</strong> написав:" ?></em>
    </div>
    <div class="panel-body">
        <?= $forwarded->text; ?>
    </div>
</div>
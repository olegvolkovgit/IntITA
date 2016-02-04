<?php
/**
 * @var $message UserMessages
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <em><?= CommonHelper::formatMessageDate($message->message0->create_date).", користувач <strong>".$message->message0->sender0->userName() .
            ", " . $message->message0->sender0->email . "</strong> написав:" ?></em>
    </div>
    <div class="panel-body">
        <?= $message->text; ?>
    </div>
</div>
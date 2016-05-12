<?php
/* @var $message UserMessages*/
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <a data-toggle="collapse" href="#collapse<?= $message->id_message; ?>" id="messageBlock">
            <img src="<?= $message->message0->sender0->avatarPath(); ?>" id="avatar"
                 style="height:24px"/>
            <strong><?= $message->message0->sender0->userName(); ?></strong>
            <em><?= substr(CHtml::encode($message->subject), 0, 50) . "..."; ?></em>
        </a>
        <div class="pull-right">
            <em><?= CommonHelper::formatMessageDate($message->message0->create_date);?></em>
        </div>
    </div>
    <div id="collapse<?= $message->id_message ?>" class="panel-collapse collapse in">
        <div class="panel-body">
            <p>
                <?=CHtml::encode($message->text);?>
                <br>
                <?php
                $forwarded = $message->message0->forwarded();
                if(!is_null($forwarded)){
                    $this->renderPartial('_forwardedMessage', array(
                        'message' => $message,
                        'forwarded' => $forwarded));
                }?>
            </p>
            <div id="form<?= $message->id_message; ?>"></div>
        </div>
    </div>
</div>
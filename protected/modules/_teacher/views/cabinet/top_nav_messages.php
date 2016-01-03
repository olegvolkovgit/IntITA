<?php
/** @var $record UserMessages
    @var $model StudentReg
 */
foreach ($newMessages as $record) {
    $message = $record->message();
    if(!$record->isRead($model))
    ?>
    <li>
        <a href="#" onclick="load('<?= Yii::app()->createUrl("/_teacher/messages/dialog", array(
            'id' => $record->id_message, 'user' => $model->id)) ?>')">
            <div>
                <strong><?= $message->sender0->userName(); ?></strong>
                <span class="pull-right text-muted">
                    <em><?= date("h:m, d F", strtotime($message->create_date)); ?></em>
                </span>
            </div>
            <div><?= $record->subject; ?></div>
        </a>
    </li>
    <?php
}
?>
<li>
    <a class="text-center" href="#">
        <strong><a href="#" onclick="load('<?=Yii::app()->createUrl("/_teacher/messages/index")?>')">
                Всі повідомлення</a></strong>
        <i class="fa fa-angle-right"></i>
    </a>
</li>
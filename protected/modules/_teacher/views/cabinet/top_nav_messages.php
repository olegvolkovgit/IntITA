<?php
/** @var $record UserMessages
 *  @var $model StudentReg
 *  @var $newMessages array
 */
foreach ($newMessages as $key=>$record) {
    $message = $record->message();
    if(!$record->isRead($model))
    ?>
    <li>
        <a href="#" onclick="load('<?= Yii::app()->createUrl("/_teacher/messages/dialog", array(
            'user1' => $message->sender0->id, 'user2' => $model->id)) ?>', 'Діалог')">
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
    if ($key >= 4) break;
}
?>
<li>
    <a class="text-center" href="#">
        <strong><a href="#" onclick="load('<?=Yii::app()->createUrl("/_teacher/messages/index")?>', 'Листування')">
                Всі повідомлення</a></strong>
        <i class="fa fa-angle-right"></i>
    </a>
</li>
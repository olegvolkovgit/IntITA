<?php
/**
 * @var $deletedMessages array
 * @var $userMessage UserMessages
 * @var $user StudentReg
 */
?>
<div class="dataTable_wrapper" style="margin-top: 5px" ng-controller="messagesCtrl">
    <table  width="100%" class="table table-striped table-bordered table-hover" cabinet-table="deletedMessages">
        <thead>
        <tr>

            <td style="width: 25%"><em>Від кого</em></td>
            <td style="width: 55%"><em>Тема</em></td>
            <td style="width: 15%"><em>Дата</em></td>
        </tr>
        </thead>
        <tbody>
            <?php
            foreach($deletedMessages as $userMessage){
                ?>
                <tr class="odd gradeX"  style="cursor:pointer">
                    
                    <td onclick="load('<?= Yii::app()->createUrl("/_teacher/messages/message", array(
                        'id' => $userMessage->id_message)) ?>', 'Видалене повідомлення')">
                        <?=$userMessage->message0->sender0->userName().", ".$userMessage->message0->sender0->email; ?>
                    </td>
                    <td onclick="load('<?= Yii::app()->createUrl("/_teacher/messages/message", array(
                        'id' => $userMessage->id_message)) ?>', 'Видалене повідомлення')">
                        <em><?= CHtml::encode($userMessage->subject); ?></em>
                    </td>
                    <td class="center">
                        <em><?=CommonHelper::formatMessageDate($userMessage->message0->create_date); ?></em>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<?php
/**
 * @var $receivedDialogs array
 * @var $userMessage UserMessages
 * @var $user StudentReg
 * @var $dialog array
 */
?>
<div class="dataTable_wrapper">
    <table class="table table-striped table-bordered table-hover" id="receivedMessages">
        <thead>
        <tr>
            <td style="width: 3%"><input type="checkbox" name="all"></td>
            <td style="width: 20%"><em>Від кого</em></td>
            <td><em>Тема</em></td>
            <td style="width: 15%"><em>Дата</em></td>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($receivedDialogs as $dialog) {
            ?>
            <tr class="odd gradeX" style="cursor:pointer" <?php //if(!$userMessage->isRead($user)) {echo 'id="new"';}?>>
                <td class="center">
                    <input type="checkbox" name="<?= $dialog["sender"];//$userMessage->id_message; ?>">
                </td>
                <td onclick="load('<?= Yii::app()->createUrl("/_teacher/messages/dialog", array(
                    'user1' =>  $dialog["sender"], 'user2' => $user->id)) ?>', 'Діалог')">
                    <?=  $dialog["sender"]//$userMessage->message0->sender0->userName(); ?>
                </td>
                <td onclick="load('<?= Yii::app()->createUrl("/_teacher/messages/dialog", array(
                    'user1' =>  $dialog["sender"], 'user2' => $user->id)) ?>', 'Діалог')">
                    <?= $dialog["subject"]; ?>
                </td>
                <td class="center">
                    <?= date("h:m, d F", strtotime( $dialog["create_date"])); ?>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
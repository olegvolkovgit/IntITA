<?php
/**
 * @var $receivedDialogs array
 * @var $userMessage UserMessages
 * @var $user StudentReg
 * @var $dialog Dialog
 */
?>
<div class="dataTable_wrapper">
    <table class="table table-striped table-bordered table-hover" id="deletedMessages">
        <thead>
        <tr>
            <td style="width: 5%"><input type="checkbox" name="all"></td>
            <td style="width: 25%"><em>Від кого</em></td>
            <td><em>Тема</em></td>
            <td style="width: 15%"><em>Дата</em></td>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($receivedDialogs as $dialog) {
            ?>
            <tr class="odd gradeX" style="cursor:pointer" <?php if(!$dialog->isRead()) {echo 'id="new"';}?>>
                <td class="center">
                    <input type="checkbox" name="<?= $dialog->receiver->id; ?>">
                </td>
                <td onclick="load('<?= Yii::app()->createUrl("/_teacher/messages/dialog", array(
                    'user1' =>  $dialog->sender->id, 'user2' => $dialog->receiver->id)) ?>', 'Діалог')">
                    <?=  $dialog->sender->userName(); ?>
                </td>
                <td onclick="load('<?= Yii::app()->createUrl("/_teacher/messages/dialog", array(
                    'user1' =>  $dialog->sender->id, 'user2' => $dialog->receiver->id)) ?>', 'Діалог')">
                    <?= $dialog->messages[0]->subject; ?>
                </td>
                <td class="center">
                    <?= date("h:m, d F", strtotime( $dialog->messages[0]->create_date)); ?>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
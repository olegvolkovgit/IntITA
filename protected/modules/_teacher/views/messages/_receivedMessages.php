<?php
/**
 * @var $receivedMessages Array
 * @var $userMessage UserMessages
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

        foreach ($receivedMessages as $userMessage) {
            ?>
            <tr class="odd gradeX" onclick="load('<?= Yii::app()->createUrl("/_teacher/messages/dialog", array(
                'id' => $userMessage->id_message)) ?>')" style="cursor:pointer"
                <?php if($userMessage->receivers()) echo 'id="new"';?>>
                <td class="center">
                    <input type="checkbox" name="<?= $userMessage->id_message; ?>">
                </td>
                <td>
                    <?= $userMessage->message0->sender0->userName(); ?>
                </td>
                <td>
                    <?= $userMessage->subject; ?>
                </td>
                <td class="center">
                    <?= date("h:m, d F", strtotime($userMessage->message0->create_date)); ?>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
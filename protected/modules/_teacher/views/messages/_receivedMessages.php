<?php
/**
 * @var $receivedMessages Array
 * @var $userMessage UserMessages
 */
?>
<div class="dataTable_wrapper">
    <table class="table table-striped table-bordered table-hover" id="receivedMessages">
        <tbody>
        <?php
        foreach($receivedMessages as $userMessage){
            ?>
            <tr class="odd gradeX">
                <td style="width: 20%">
                    <a href="#" onclick="load('<?=Yii::app()->createUrl("/_teacher/messages/dialog", array(
                        'id' => $userMessage->id_message))?>')">
                    <?=$userMessage->message0->sender0->userName(); ?></a>
                </td>
                <td><a href="#" onclick="load('<?=Yii::app()->createUrl("/_teacher/messages/dialog", array(
                        'id' => $userMessage->id_message))?>')">
                        <?=$userMessage->subject; ?></a>
                </td>
                <td class="center" style="width: 15%">
                    <?=date("h:m, d F", strtotime($userMessage->message0->create_date)); ?>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
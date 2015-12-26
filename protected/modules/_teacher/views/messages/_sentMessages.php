<?php
/**
 * @var $sentMessages Array
 * @var $userMessage UserMessages
 */
?>
<div class="dataTable_wrapper">
    <table class="table table-striped table-bordered table-hover" id="sentMessages">
        <thead>
        <tr>
            <td style="width: 3%"><input type="checkbox" name="all"></td>
            <td style="width: 20%"><em>Кому</em></td>
            <td><em>Тема</em></td>
            <td style="width: 15%"><em>Дата</em></td>
        </tr>
        </thead>
        <tbody>
        <form>
        <?php
            foreach($sentMessages as $userMessage){
                ?>
                <tr class="odd gradeX" onclick="load('<?= Yii::app()->createUrl("/_teacher/messages/dialog", array(
                    'id' => $userMessage->id_message)) ?>')" style="cursor:pointer">
                    <td class="center">
                        <input type="checkbox" name="<?=$userMessage->id_message;?>">
                    </td>
                    <td>
                       <?=$userMessage->receiversString(); ?>
                    </td>
                    <td>
                        <?=$userMessage->subject; ?>
                    </td>
                    <td class="center"><?=date("h:m, d F", strtotime($userMessage->message0->create_date)); ?></td>
                </tr>
            <?php
            }
        ?>
        </form>
        </tbody>
    </table>
</div>
<?php
/**
 * @var $sentMessages array
 * @var $sentDialogs array
 * @var $userMessage UserMessages
 * @var $user StudentReg
 * @var $dialog Dialog
 */
?>
<div class="dataTable_wrapper">
    <table class="table table-striped table-bordered table-hover" id="sentMessages">
        <thead>
        <tr>
            <td style="width: 3%"><input type="checkbox" name="all" onclick="checkAll();"></td>
            <td style="width: 20%"><em>Кому</em></td>
            <td><em>Тема</em></td>
            <td style="width: 15%"><em>Дата</em></td>
        </tr>
        </thead>
        <tbody>
        <form>
        <?php
            foreach($sentDialogs as $dialog){
                var_dump($sentDialogs);die;
                ?>
                <tr class="odd gradeX"  style="cursor:pointer">
                    <td class="center">
                        <input type="checkbox" id="">
                    </td>
                    <td onclick="load('<?= Yii::app()->createUrl("/_teacher/messages/dialog", array(
                        'user1' => $dialog->receiver->id, 'user2' => $dialog->sender->id)) ?>', 'Діалог')">
                       <?=$dialog->receiver->userName(); ?>
                    </td>
                    <td onclick="load('<?= Yii::app()->createUrl("/_teacher/messages/dialog", array(
                        'user1' => $dialog->receiver->id, 'user2' => $dialog->sender->id)) ?>', 'Діалог')">
                        <?=$dialog->header; ?>
                    </td>
                    <td class="center"><?=date("h:m, d F", strtotime($dialog["create_date"])); ?></td>
                </tr>
            <?php
            }
        ?>
        </form>
        </tbody>
    </table>
</div>

<script>
    function checkAll(){

    }
</script>
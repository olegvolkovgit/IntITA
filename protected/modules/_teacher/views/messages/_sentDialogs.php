<?php
/**
 * @var $sentMessages array
 * @var $sentDialogs array
 * @var $userMessage UserMessages
 * @var $user StudentReg
 */
//var_dump($sentDialogs);die;
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
                ?>
                <tr class="odd gradeX"  style="cursor:pointer">
                    <td class="center">
                        <input type="checkbox" id="<?=$dialog["id_message"];?>">
                    </td>
                    <td onclick="load('<?= Yii::app()->createUrl("/_teacher/messages/dialog", array(
                        'id' => $dialog["id_message"], 'user' => $user->id)) ?>', 'Діалог')">
                       <?=$dialog["id_receiver"]; ?>
                    </td>
                    <td onclick="load('<?= Yii::app()->createUrl("/_teacher/messages/dialog", array(
                        'id' => $dialog["id_message"], 'user' => $user->id)) ?>', 'Діалог')">
                        <?=$dialog["subject"]; ?>
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
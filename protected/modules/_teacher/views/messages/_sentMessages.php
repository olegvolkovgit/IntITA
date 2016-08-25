<?php
/**
 * @var $sentMessages array
 * @var $userMessage UserMessages
 * @var $user StudentReg
 */
?>
<div class="dataTable_wrapper" style="margin-top: 5px" >
    <table class="table table-striped table-bordered table-hover" width="100%" cabinet-table="">
        <thead>
        <tr>
            <td style="width: 5%"><input type="checkbox" name="all" onclick="checkAll();"></td>
            <td style="width: 25%"><em>Кому</em></td>
            <td style="width: 55%"><em>Тема</em></td>
            <td style="width: 15%"><em>Дата</em></td>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($sentMessages as $userMessage) {
            ?>
            <tr class="odd gradeX" style="cursor:pointer">
                <td class="center" style="width: 5%">
                    <input type="checkbox" id="<?= $userMessage->id_message; ?>">
                </td>
                <td>
                    <a ng-href="#/dialog/<?php echo $userMessage->receivers()[0]->id ?>/<?php echo $user->id ?>">
                    <?= $userMessage->receiversString(); ?>
                </td>
                <td>
                    <a ng-href="#/dialog/<?php echo $userMessage->receivers()[0]->id ?>/<?php echo $user->id ?>">
                    <em><?= CHtml::encode($userMessage->subject); ?></em>
                </td>
                <td class="center">
                    <em><?= CommonHelper::formatMessageDate($userMessage->message0->create_date); ?></em>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
<script>
    function checkAll() {
    }
</script>
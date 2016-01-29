<?php
/**
 * @var $sentMessages array
 * @var $userMessage UserMessages
 * @var $user StudentReg
 */
?>
<div class="dataTable_wrapper">
    <table class="table table-striped table-bordered table-hover" id="sentMessages">
        <thead>
        <tr>
            <td style="width: 3%"><input type="checkbox" name="all" onclick="checkAll();"></td>
            <td style="width: 25%"><em>Кому</em></td>
            <td><em>Тема</em></td>
            <td style="width: 15%"><em>Дата</em></td>
        </tr>
        </thead>
        <tbody>
        <form>
            <?php
            foreach ($sentMessages as $userMessage) {
                ?>
                <tr class="odd gradeX" style="cursor:pointer">
                    <td class="center">
                        <input type="checkbox" id="<?= $userMessage->id_message; ?>">
                    </td>
                    <td onclick="load('<?= Yii::app()->createUrl("/_teacher/messages/dialog", array(
                        'user1' => 38, 'user2' => $user->id)) ?>')">
                        <?= $userMessage->receiversString(); ?>
                    </td>
                    <td onclick="load('<?= Yii::app()->createUrl("/_teacher/messages/dialog", array(
                        'user1' => 38, 'user2' => $user->id)) ?>')">
                        <?= $userMessage->subject; ?>
                    </td>
                    <td class="center">
                        <em><?= CommonHelper::formatMessageDate($userMessage->message0->create_date); ?></em></td>
                </tr>
                <?php
            }
            ?>
        </form>
        </tbody>
    </table>
</div>
<script>
    function checkAll() {
    }
</script>
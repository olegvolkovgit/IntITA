<?php
/**
 * @var $receivedMessages array
 * @var $message
 * @var $user StudentReg
 */
?>
<div class="dataTable_wrapper" style="margin-top: 5px"  >
    <table datatable="" dt-options="dtOptions" dt-instance="dtInstance"  dt-columns="dtColumns" class="table table-striped table-bordered table-hover" width="100%"  >
        <thead>
        <tr>
            <td style="width: 5%"><input type="checkbox" name="all"></td>
            <td style="width: 25%"><em>Від кого</em></td>
            <td style="width: 55%"><em>Тема</em></td>
            <td style="width: 15%"><em>Дата</em></td>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($receivedMessages as $message) {
            ?>
            <tr class="odd gradeX" style="cursor:pointer" <?php if(!$message->isRead($user)) {echo 'id="new"';}?> ng-click="changeView('dialog/<?= $message->message0->sender0->id ?>/<?=$user->id?>')">
                <td class="center" style="width: 5%">
                    <input type="checkbox" name="<?= $message->id_message; ?>">
                </td>
                <td >
                    <?= $message->message0->sender0->userName() . ", " . $message->message0->sender0->email; ?>
                </td>
                <td>
                    <em><?= CHtml::encode($message->subject()); ?></em>
                </td>
                <td class="center">
                    <em><?= CommonHelper::formatMessageDate($message->message0->create_date); ?></em>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
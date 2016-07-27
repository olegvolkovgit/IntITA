<?php
/**
 * @var $model UserAgreements
 */
?>
    <br>
    <button class="btn btn-primary"
            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/invoices/invoicesList', array('id'=> $model->id));?>',
                'Список рахунків по договору №<?=$model->number;?>')">Рахунки по договору
    </button>
    <br>
    <br>
    <table class="detail-view">
        <tbody>
            <tr class="odd"><th>ID договору:</th><td><?php echo $model->id ?></td></tr>
            <tr class="even"><th>Номер:</th><td><?php echo $model->number ?></td></tr>
            <tr class="odd"><th>Service:</th><td><?php echo $model->service->description." (id=".$model->service_id.')' ?></td></tr>
            <tr class="even"><th>Дата створення:</th><td><?php echo $model->create_date ?></td></tr>
            <tr class="odd"><th>Користувач:</th><td><?php echo trim($model->user->firstName.' '.$model->user->secondName.' ('.$model->user->email.')') ?></td></tr>
            <tr class="even"><th>Сума:</th><td><?php echo $model->summa ?></td></tr>
            <tr class="odd"><th>Підтверджено користувачем:</th><td><?php echo $model->approvalUser?trim($model->approvalUser->firstName.' '.$model->approvalUser->secondName.' ('.$model->approvalUser->email.')'):'' ?></td></tr>
            <tr class="even"><th>Дата підтвердження:</th><td><?php echo $model->approval_date ?></td></tr>
            <tr class="odd"><th>Закрив договір:</th><td><?php echo $model->cancelUser?trim($model->cancelUser->firstName.' '.$model->cancelUser->secondName.' ('.$model->cancelUser->email.')'):'' ?></td></tr>
            <tr class="even"><th>Дата відміни:</th><td><?php echo $model->cancel_date ?></td></tr>
            <tr class="odd"><th>Дата закриття:</th><td><?php echo ($model->close_date=='0000-00-00 00:00:00')?'':$model->close_date ?></td></tr>
            <tr class="even"><th>Схема оплати:</th><td><?php echo $model->paymentSchema->name ?></td></tr>
            <tr class="odd"><th>Причина закриття:</th><td><?php echo $model->cancel_reason_type ?></td></tr>
        </tbody>
    </table>
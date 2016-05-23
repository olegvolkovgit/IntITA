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
<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'number',
        'service_id',
        'create_date',
        'user_id',
        'summa',
        'approval_user',
        'approval_date',
        'cancel_user',
        'cancel_date',
        'close_date',
        'payment_schema',
        'cancel_reason_type',
    ),
)); ?>
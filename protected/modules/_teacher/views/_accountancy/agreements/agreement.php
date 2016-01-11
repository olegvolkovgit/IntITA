<?php
/**
 * @var $model UserAgreements
 */
?>
<br>
<h1>Договір № <?php echo $model->number;?></h1>
<a href="<?php echo Yii::app()->createUrl('/_accountancy/invoices/invoicesList', array('id'=> $model->id));?>">
    Рахунки по договору
</a>
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
<?php
/**
 * @var $model UserAgreements
 */
$this->pageTitle = 'INTITA';
?>
<h1>Договір № <?php echo $model->number;?></h1>
<a href="<?php echo Yii::app()->createUrl('/_accountancy/invoices/agreementList', array('id'=> $model->id));?>">
    Рахунки договора
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
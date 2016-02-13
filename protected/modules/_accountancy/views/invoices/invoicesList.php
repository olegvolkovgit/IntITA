<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 19.11.2015
 * Time: 16:49
 */
?>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/invoicesList.css" />

<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_accountancy/invoices/');?>">Список всіх рахунків</a>
<br>
<br>

<h1>Список рахунків по договору</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'invoices-grid',
    'dataProvider'=>$dataProvider,
    //'filter'=>$dataProvider,
    'summaryText'=>'',
    'emptyText'=>'Рахунків немає',
    'columns'=>array(
        array(
            'header' => 'Договір',
            'class'=>'CLinkColumn',
            'urlExpression'=>'Yii::app()->createUrl("/_accountancy/userAgreements/agreement",
            array("id"=>$data->agreement_id))',
            'htmlOptions'=>array('style'=>'cursor: pointer;'),
            'labelExpression' => 'UserAgreements::getNumber($data->agreement_id)'
        ),
        array(
            'name' => 'date_created',
            'htmlOptions'=>array('class'=>'date'),
            'value' => '($data->date_created)? date("d.m.y", strtotime($data->date_created)):""',
        ),
        array(
            'name' => 'summa',
            'value' => '$data->summa." грн."',
        ),
        array(
            'name' => 'user_created',
            'value' => 'StudentReg::getUserNamePayment($data->user_created)',
        ),
        array(
            'name' => 'payment_date',
            'htmlOptions'=>array('class'=>'date'),
            'value' => '($data->payment_date)? date("d.m.y", strtotime($data->payment_date)):""',
        ),
        array(
            'name' => 'pay_date',
            'htmlOptions'=>array('class'=>'date'),
            'value' => '($data->pay_date)? date("d.m.y", strtotime($data->pay_date)):""',
        ),
        array(
            'name' => 'expiration_date',
            'htmlOptions'=>array('class'=>'date'),
            'value' => '($data->expiration_date)? date("d.m.y", strtotime($data->expiration_date)):""',
        ),
        array(
            'name' => 'user_cancelled',
            'value' => 'StudentReg::getUserNamePayment($data->user_cancelled)',
        ),
    ),
)); ?>

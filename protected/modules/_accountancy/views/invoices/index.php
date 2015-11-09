<?php
/* @var $this InvoicesController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = 'INTITA - Список рахунків';
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-agreements-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Список рахунків</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'invoices-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'summaryText'=>'',
    'emptyText'=>'Рахунків немає',
    'columns'=>array(
        //'id',
        array(
            'header' => 'agreement_id',
            'class'=>'CLinkColumn',
            'urlExpression'=>'Yii::app()->createUrl("/_accountancy/userAgreements/agreement",
            array("id"=>$data->agreement_id))',
            'htmlOptions'=>array('style'=>'cursor: pointer;'),
            'headerHtmlOptions' => array('style' => 'display:none'),
            'labelExpression' => 'UserAgreements::getNumber($data->agreement_id)'
        ),
        array(
            'name' => 'date_created',
            'value' => 'UserAgreements::getFormatDate($data->date_created)',
        ),
        array(
            'name' => 'summa',
            'value' => '$data->summa',
        ),
        array(
            'name' => 'user_created',
            'value' => 'StudentReg::getUserName($data->user_created)',
        ),
        array(
            'name' => 'payment_date',
            'value' => 'UserAgreements::getFormatDate($data->payment_date)',
        ),
        array(
            'name' => 'expiration_date',
            'value' => 'UserAgreements::getFormatDate($data->expiration_date)',
        ),
        array(
            'name' => 'user_cancelled',
            'value' => 'StudentReg::getUserName($data->user_cancelled)',
        ),
        array(
            'name' => 'pay_date',
            'value' => 'UserAgreements::getFormatDate($data->pay_date)',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{confirm}{cancel}',
            'buttons' => array
            (
                'confirm'=>array(
                    'label' => 'Сплатити',
                    'url' => 'Yii::app()->createUrl("/_accountancy/invoices/confirm", array("id"=>$data->id));',
                    'imageUrl' => StaticFilesHelper::createPath('image', 'common', 'confirm.png'),
                ),
                'cancel'=>array(
                    'label' => 'Скасувати',
                    'url' => 'Yii::app()->createUrl("/_accountancy/invoices/cancel", array("id"=>$data->id));',
                    'imageUrl' => StaticFilesHelper::createPath('image', 'common', 'cancel.png'),
                ),
            ),
        ),
    ),
)); ?>

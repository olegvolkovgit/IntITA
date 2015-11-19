<?php

/* @var $this UserAgreementsController */
/* @var $dataProvider CActiveDataProvider */
//$this->pageTitle = 'INTITA - Список договорів';
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

<h1>Список договорів</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'user-agreements-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'summaryText'=>'',
    'emptyText'=>'Договорів не знайдено',
    'columns'=>array(
        array(
            'header' => 'Номер',
            'class'=>'CLinkColumn',
            'urlExpression'=>'Yii::app()->createUrl("/_accountancy/userAgreements/agreement", array("id"=>$data->id))',
            'htmlOptions'=>array('style'=>'cursor: pointer;'),
            'labelExpression' => '$data->number'
        ),
        array(
            'name' => 'user_id',
            'value' => 'StudentReg::getUserName($data->user_id)',
        ),
        array(
            'name' => 'create_date',
            'value' => 'UserAgreements::getFormatDate($data->create_date)',
        ),
        array(
            'name' => 'approval_user',
            'value' => 'StudentReg::getUserName($data->approval_user)',
        ),
        array(
            'name' => 'approval_date',
            'value' => 'UserAgreements::getFormatDate($data->approval_date)',
        ),
        array(
            'name' => 'cancel_user',
            'value' => 'StudentReg::getUserName($data->cancel_user)',
        ),
        array(
            'name' => 'cancel_date',
            'value' => 'UserAgreements::getFormatDate($data->cancel_date)',
        ),
        array(
            'name' => 'close_date',
            'value' => 'UserAgreements::getFormatDate($data->close_date)',
        ),
        array(
            'name' => 'payment_schema',
            'value' => 'PaymentScheme::getName($data->payment_schema)',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{confirm}{cancel}',
            'buttons' => array
            (
                'confirm'=>array(
                    'label' => 'Підтвердити',
                    'url' => 'Yii::app()->createUrl("/_accountancy/userAgreements/confirm", array("id"=>$data->id));',
                    'imageUrl' => StaticFilesHelper::createPath('image', 'common', 'confirm.png'),
                ),
                'cancel'=>array(
                    'label' => 'Відмінити',
                    'url' => 'Yii::app()->createUrl("/_accountancy/userAgreements/cancel", array("id"=>$data->id));',
                    'imageUrl' => StaticFilesHelper::createPath('image', 'common', 'cancel.png'),
                ),
            ),
        ),
    ),
)); ?>

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
        'id',
        'agreement_id',
        'date_created',
        'summa',
        'user_created',
        'payment_date',
        'expiration_date',
        'user_cancelled',
        'pay_date',
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

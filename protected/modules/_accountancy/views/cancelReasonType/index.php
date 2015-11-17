<?php
/* @var $this CancelReasonTypeController */
/* @var $dataProvider CActiveDataProvider */
?>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_accountancy/cancelReasonType/create');?>">Додати</a>

<h1>Причини відміни операцій</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'summaryText'=>'',
)); ?>

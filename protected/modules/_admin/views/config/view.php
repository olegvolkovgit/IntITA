<?php
/* @var $this ConfigController */
/* @var $model Config */
?>
<a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/config/index');?>">Список налаштувань</a>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/config/update', array('id' => $model->id));?>">Редагувати налаштування</a>


<h1>Перегляд налаштування #<?php echo $model->param; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'param',
		'value',
		'default',
		'label',
		'type',
	),
)); ?>

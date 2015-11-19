<?php
/* @var $this ExternalSourcesController */
/* @var $model ExternalSources */
?>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_accountancy/externalSources/create');?>">Додати</a>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_accountancy/externalSources/');?>">Список зовнішніх джерел</a>
<br>

<h1>Перегляд зовнішніх джерел <?php echo $model->id; ?></h1>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'cash',
	),
)); ?>

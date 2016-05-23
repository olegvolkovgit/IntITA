<?php
/* @var $this ExternalSourcesController */
/* @var $model ExternalSources */
?>
<div class="col-lg-12">
	<br>
	<button class="btn btn-primary"
			onclick="load('<?php echo Yii::app()->createUrl("/_teacher/_accountant/externalSources/index"); ?>',
				'Джерела зовнішніх коштів')">Всі джерела зовнішніх коштів
	</button>
	<br>
	<br>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'cash',
	),
)); ?>
</div>

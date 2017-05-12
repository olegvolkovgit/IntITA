<?php
/* @var $this ExternalSourcesController */
/* @var $model ExternalSources */
?>
<div class="col-lg-12">
	<br>
	<a class="btn btn-primary" ng-href="#/auditor/externalsources">Всі джерела зовнішніх коштів</a>
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

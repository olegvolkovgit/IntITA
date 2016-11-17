<?php
/* @var $this MailTemplatesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mail Templates',
);

$this->menu=array(
	array('label'=>'Create MailTemplates', 'url'=>array('create')),
	array('label'=>'Manage MailTemplates', 'url'=>array('admin')),
);
?>

<h1>Mail Templates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

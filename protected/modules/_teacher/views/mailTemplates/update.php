<?php
/* @var $this MailTemplatesController */
/* @var $model MailTemplates */

$this->breadcrumbs=array(
	'Mail Templates'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MailTemplates', 'url'=>array('index')),
	array('label'=>'Create MailTemplates', 'url'=>array('create')),
	array('label'=>'View MailTemplates', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MailTemplates', 'url'=>array('admin')),
);
?>

<h1>Update MailTemplates <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
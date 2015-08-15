<?php
/* @var $this MessagesController */
/* @var $model Messages */

$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->id_record=>array('view','id'=>$model->id_record),
	'Update',
);

$this->menu=array(
	array('label'=>'List Messages', 'url'=>array('index')),
	array('label'=>'Create Messages', 'url'=>array('create')),
	array('label'=>'View Messages', 'url'=>array('view', 'id'=>$model->id_record)),
	array('label'=>'Manage Messages', 'url'=>array('admin')),
);
?>

<h1>Update Messages <?php echo $model->id_record; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
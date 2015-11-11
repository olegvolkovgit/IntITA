<?php
/* @var $this OperationController */
/* @var $model Operation */

//$this->menu=array(
//	array('label'=>'List Operation', 'url'=>array('index')),
//	array('label'=>'Create Operation', 'url'=>array('create')),
//	array('label'=>'View Operation', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage Operation', 'url'=>array('admin')),
//);
?>

<h1>Update Operation <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
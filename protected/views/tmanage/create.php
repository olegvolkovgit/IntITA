<?php
/* @var $this MytestController */
/* @var $model Teacher */

$this->breadcrumbs=array(
	'Teachers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Всі вчителі', 'url'=>array('index')),
	array('label'=>'Управління вчителями', 'url'=>array('admin')),
);
?>

<h1>Create Teacher</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
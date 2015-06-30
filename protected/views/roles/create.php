<?php
/* @var $this RolesController */
/* @var $model Roles */

$this->breadcrumbs=array(
	'Ролі викладачів'=>array('index'),
	'Створити роль',
);

?>

<h1>Створити роль</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
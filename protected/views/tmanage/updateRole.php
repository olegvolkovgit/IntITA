<?php
/* @var $this TmanageController */
/* @var $model Roles */

$this->breadcrumbs=array(
    'Ролі викладачів'=>array('index'),
    'Роль '.$model->title_ua=>array('view','id'=>$model->id),
    'Редагувати роль',
);

$this->menu=array(
    array('label'=>'Список ролей', 'url'=>array('index')),
    array('label'=>'Створити роль', 'url'=>array('create')),
    array('label'=>'Переглянути роль', 'url'=>array('view', 'id'=>$model->id)),
);
?>

    <h1>Редагувати роль <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_formRole', array('model'=>$model)); ?>
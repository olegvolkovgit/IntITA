<?php
/* @var $model Teacher */
$this->breadcrumbs=array(
    'Викладачі'=>array('index'),
    "{$model->last_name} {$model->first_name} {$model->middle_name}"=>array('view','id'=>$model->teacher_id),
    'Оновити викладача',
);
$this->menu=array(
    array('label'=>'Список викладачів', 'url'=>array('index')),
    array('label'=>'Додати викладача', 'url'=>array('create')),
    array('label'=>'Показати викладача', 'url'=>array('view', 'id'=>$model->teacher_id)),
    array('label'=>'Управління викладачами', 'url'=>array('admin')),
);
?>

    <h1>Оновлення <?php echo "{$model->last_name} {$model->first_name} {$model->middle_name}"; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'scenario' => 'update')); ?>
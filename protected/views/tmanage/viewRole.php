<?php
/* @var $this TmanageController */
/* @var $model Roles */

$this->breadcrumbs=array(
    'Ролі викладачів'=>array('roles'),
    $model->title_ua,
);

$this->menu=array(
    array('label'=>'Список ролей', 'url'=>array('tmanage/roles')),
);
?>

    <h1>Роль викладача  <?php echo $model->title_ua; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'title_en',
        'title_ru',
        'title_ua',
        'description',
    ),
)); ?>
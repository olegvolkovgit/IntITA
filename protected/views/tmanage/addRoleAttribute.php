<?php
/* @var $this RoleAttributeController */
/* @var $model RoleAttribute */

$this->breadcrumbs=array(
    'Ролі викладачів'=>array('roles'),
    'Додати атрибут ролі'.$model->name_ua,
);

$this->menu=array(
    //array('label'=>'Список атрибутів ролі', 'url'=>array('/tmanage/showAttributes/?role='.$model->role)),
    array('label'=>'Роль', 'url'=>array('roles')),
);
?>

    <h1>Додати атрибут ролі</h1>

<?php $this->renderPartial('_formRoleAttribute', array('model'=>$model)); ?>
<?php
/* @var $this RoleAttributeController */
/* @var $model RoleAttribute */

$this->breadcrumbs=array(
    'Ролі викладачів'=>array('roles'),
    'Додати роль',
);

$this->menu=array(
    array('label'=>'Список атрибутів ролі', 'url'=>array('index')),
    array('label'=>'Управління атрибутами ролі', 'url'=>array('admin')),
);
?>

    <h1>Додати атрибут ролі</h1>

<?php $this->renderPartial('_formRoleAttribute', array('model'=>$model)); ?>
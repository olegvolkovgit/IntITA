<?php
/* @var $this RoleAttributeController */
/* @var $model RoleAttribute */

$this->breadcrumbs=array(
    'Role Attributes'=>array('index'),
    'Create',
);

$this->menu=array(
    array('label'=>'Список атрибутів ролі', 'url'=>array('index')),
    array('label'=>'Управління атрибутами ролі', 'url'=>array('admin')),
);
?>

    <h1>Create RoleAttribute</h1>

<?php $this->renderPartial('_formRoleAttribute', array('model'=>$model)); ?>
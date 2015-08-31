<?php
/* @var $this TmanageController */
/* @var $model RoleAttribute */


$this->menu=array(
    //array('label'=>'Список атрибутів ролі', 'url'=>array('/tmanage/showAttributes/?role='.$model->role)),
    array('label'=>'Роль', 'url'=>array('roles')),
);
?>
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/roles.css" />

    <a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/roles');?>">Список ролей</a>

    <h1>Додати атрибут ролі</h1>

<?php $this->renderPartial('_formRoleAttribute', array('model'=>$model)); ?>
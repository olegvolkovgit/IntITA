<?php
/* @var $this TmanageController */
/* @var $model RoleAttribute */


$this->menu=array(
    //array('label'=>'Список атрибутів ролі', 'url'=>array('/tmanage/showAttributes/?role='.$model->role)),
    array('label'=>'Роль', 'url'=>array('roles')),
);
?>
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/roles.css" />

    <br>
    <br>
    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/roles');?>">Список ролей</a>
    </button>
    <div class="page-header">
    <h1>Додати атрибут ролі</h1>
    </div>
<?php $this->renderPartial('_formRoleAttribute', array('model'=>$model)); ?>
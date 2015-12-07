<?php
/* @var $this TmanageController */
/* @var $model RoleAttribute */

//$this->breadcrumbs=array(
//	'Ролі викладачів'=>array('tmanage/roles'),
//	'Атрибут '.$model->name_ua=>array('view','id'=>$model->id),
//	'Редагувати',
//);
?>
    <div class="page-header">
    <h1>Редагувати атрибут ролі <?php echo $model->name_ua; ?></h1>
    </div>
<?php $this->renderPartial('_formRoleAttribute', array('model'=>$model)); ?>
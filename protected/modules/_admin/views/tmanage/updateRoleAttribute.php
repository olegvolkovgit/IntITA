<?php
/* @var $this TmanageController */
/* @var $model RoleAttribute */
?>
    <div class="page-header">
    <h1>Редагувати атрибут ролі <?php echo $model->name_ua; ?></h1>
    </div>
<?php $this->renderPartial('_formRoleAttribute', array('model'=>$model)); ?>
<?php
/* @var $this TmanageController */
/* @var $model Roles */
?>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/roles');?>">Список ролей</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/createRole');?>">Створити роль</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/viewRole', array('id' => $model->id));?>">
        Переглянути роль
    </a>
    <div class="page-header">
    <h1>Редагувати роль <?php echo $model->id; ?></h1>
    </div>
<?php $this->renderPartial('_formRole', array('model'=>$model)); ?>
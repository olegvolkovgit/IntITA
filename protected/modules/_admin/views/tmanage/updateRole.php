<?php
/* @var $this TmanageController */
/* @var $model Roles */
?>
    <a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/roles');?>">Список ролей</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/createRole');?>">Створити роль</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/viewRole', array('id' => $model->id));?>">Переглянути роль</a>

    <h1>Редагувати роль <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_formRole', array('model'=>$model)); ?>
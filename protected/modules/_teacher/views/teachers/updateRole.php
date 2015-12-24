<?php
/* @var $this TmanageController */
/* @var $model Roles */
?>
    <br>
    <br>
    <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/teachers/roles');?>')">Список ролей</a>
    <br>
    <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/teachers/createRole');?>')">Створити роль</a>
    <br>
    <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/teachers/viewRole', array('id' => $model->id));?>')">
        Переглянути роль
    </a>
    <div class="page-header">
    <h1>Редагувати роль <?php echo $model->id; ?></h1>
    </div>
<?php $this->renderPartial('_formRole', array('model'=>$model)); ?>
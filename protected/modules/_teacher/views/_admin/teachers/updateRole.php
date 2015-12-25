<?php
/* @var $this TmanageController */
/* @var $model Roles */
?>
    <ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/roles');?>')">Список ролей</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/createRole');?>')">Створити роль</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/viewRole', array('id' => $model->id));?>')">
                Переглянути роль
        </button>
    </li>
    </ul>
    <div class="page-header">
    <h4>Редагувати роль <?php echo $model->id; ?></h4>
    </div>
<?php $this->renderPartial('_formRole', array('model'=>$model)); ?>
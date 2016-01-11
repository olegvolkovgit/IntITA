<br>
<br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/module/index'); ?>">Список модулів</a>
<br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/module/mandatory', array('id' => $model->module_ID)); ?>">
        Додати попередній модуль у курсі
    </a>
<br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/module/coursePrice', array('id' => $model->module_ID)); ?>">
        Додати/змінити ціну модуля у курсі
    </a>
<br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/module/view', array('id' => $model->module_ID)); ?>">
        Переглянути модуль
    </a>

<div class="page-header">
    <h1>Редагувати інформацію про <?php echo $model->module_number . " " . $model->title_ua; ?></h1>
</div>

<?php $this->renderPartial('_formAddModule', array('model' => $model)); ?>

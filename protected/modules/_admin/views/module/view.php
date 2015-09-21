<?php
/* @var $this ModuleController */
/* @var $model Module */
?>
    <a href="<?php echo Yii::app()->createUrl('/_admin'); ?>">Система управління контентом IntITA - Головна</a>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/module/index');?>">Список модулів</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/module/update', array('id' => $model->module_ID));?>">Редагувати модуль</a>

    <h2>Модуль #<?php echo $model->module_number." ".$model->title_ua; ?></h2>


<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'module_ID',
        'language',
        'title_ua',
        'title_ru',
        'title_en',
        'alias',
        'module_number',
        'module_price',
        'lesson_count',
        'module_duration_days'
    ),
)); ?>
<?php
/* @var $this GraduateController */
/* @var $model Graduate */
?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'adminGraduate.css'); ?>"/>
<br>
<br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/graduate/create'); ?>">Додати випускника</a>
<br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/graduate/index'); ?>">Список випускників</a>
<br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/graduate/update', array('id' => $model->id)); ?>">Редагувати
        інформацію про випускника</a>
<div class="page-header">
    <h1>Переглянути інформацію про випускника #<?php echo addslashes($model->first_name . " " . $model->last_name); ?> </h1>
</div>
<div class="graduateView">
    <?php $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'attributes' => array(
            'first_name',
            'last_name',
            array(
                'header' => 'Аватар',
                'value' => StaticFilesHelper::createPath('image', 'graduates', $model->avatar),
                'type' => 'image',
            ),
            'graduate_date',
            'position',
            'work_place',
            'work_site',
            'courses_page',
            'rate',
            'recall',
            'first_name_en',
            'last_name_en',
        ),
    )); ?>
</div>

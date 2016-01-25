<?php
/* @var $this GraduateController */
/* @var $model Graduate */
?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'adminGraduate.css'); ?>"/>

<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/create'); ?>',
                    'Додати випускника')">
            Додати випускника</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/index'); ?>',
                    'Список випускників')">
            Список випускників</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/update', array('id' => $model->id)); ?>',
                    'Редагувати інформацію про випускника')">
            Редагувати інформацію про випускника</button>
    </li>
</ul>

<div class="page-header">
    <h4>Переглянути інформацію про випускника #<?php echo $model->first_name . " " . $model->last_name; ?> </h4>
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

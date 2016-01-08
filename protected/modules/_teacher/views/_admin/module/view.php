<?php
/* @var $this ModuleController */
/* @var $model Module */
?>

    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/index'); ?>')">
                Список модулів</button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/update',
                        array('id' => $model->module_ID)); ?>')">Редагувати модуль</button>
        </li>
    </ul>

    <div class="page-header">
        <h4>Модуль #<?php echo $model->module_number . " " . $model->title_ua; ?></h4>
    </div>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
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
<?php
/* @var $this ModuleController */
/* @var $model Module */
?>
<div class="page-header">
<h1>View Module #<?php echo $model->module_ID; ?></h1>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'module_ID',
        'title_ru',
        'module_number',
        'title_en',
        'title_ua',
        'alias',
        'language',
        'module_duration_hours',
        'module_duration_days',
        'lesson_count',
        'module_price',
        'for_whom',
        'what_you_learn',
        'what_you_get',
        'module_img',
        'about_module',
        'owners',
        'level',
        'hours_in_day',
        'days_in_week',
        'rating',
    ),
)); ?>

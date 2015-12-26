<?php
/* @var $this CoursemanageController */
/* @var $model Course */
?>
    <br>
    <br>
        <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/create'); ?>">Додати курс</a>
    <br>
        <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/index'); ?>">Список курсів</a>
    <br>
        <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/update', array('id' => $model->course_ID)); ?>">
            Редагувати курс
        </a>

    <div class="page-header">
        <h1>Курс <?php echo $model->getTitle(); ?></h1>
    </div>
<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'course_ID',
        'language',
        'title_ua',
        'title_ru',
        'title_en',
        'level',
        'start',
        'status',
        'for_whom_ua',
        'what_you_learn_ua',
        'what_you_get_ua',
        'for_whom_ru',
        'what_you_learn_ru',
        'what_you_get_ru',
        'for_whom_en',
        'what_you_learn_en',
        'what_you_get_en',
        'course_img',
    ),
)); ?>
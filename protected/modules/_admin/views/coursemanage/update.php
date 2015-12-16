<?php
/* @var $this CoursemanageController */
/* @var $model Course */
?>
    <br>
    <button type="button" class="btn btn-link">
        <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/create'); ?>">Додати курс</a>
    </button>
    <br>
    <button type="button" class="btn btn-link">
        <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/index'); ?>">Список курсів</a>
    </button>
    <br>
    <button type="button" class="btn btn-link">
        <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/view', array('id' => $model->course_ID)); ?>">
            Переглянути інформацію про курс
        </a>
    </button>
    <br>
    <button type="button" class="btn btn-link">
        <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/schema', array('idCourse' => $model->course_ID)); ?>">
            Згенерувати схему курса
        </a>
    </button>
    <div class="page-header">
        <h1>Оновити курс <?php echo $model->title_ua . " (" . $model->language . ")"; ?></h1>
    </div>
<?php $this->renderPartial('_form', array('model' => $model)); ?>
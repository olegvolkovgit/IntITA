<?php
/* @var $this CoursemanageController */
/* @var $model Course */
?>
    <br>
        <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/create'); ?>">Додати курс</a>
    <br>
        <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/index'); ?>">Список курсів</a>
    <br>
        <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/view', array('id' => $model->course_ID)); ?>">
            Переглянути інформацію про курс
        </a>
    <br>
        <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/schema', array('idCourse' => $model->course_ID)); ?>">
            Згенерувати схему курсу
        </a>
    <div class="page-header">
        <h1>Оновити курс <?php echo $model->title_ua . " (" . $model->language . ")"; ?></h1>
    </div>
<?php $this->renderPartial('_form', array('model' => $model)); ?>
<?php
/* @var $this CoursemanageController */
/* @var $model Course */
?>
    <a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/create');?>">Додати курс</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/index');?>">Список курсів</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/coursemanage/view', array('id' => $model->course_ID));?>">Переглянути інформацію про курс</a>


    <h1>Оновити курс <?php echo $model->title_ua." (".$model->language.")"; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>